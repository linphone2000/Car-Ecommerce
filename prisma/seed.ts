import { PrismaClient, Role } from "@prisma/client";
import bcrypt from "bcryptjs";

const prisma = new PrismaClient();

async function main() {
  const passwordHash = await bcrypt.hash("password123", 10);

  const admin = await prisma.user.upsert({
    where: { email: "admin@revupauto.com" },
    update: {},
    create: {
      email: "admin@revupauto.com",
      password: passwordHash,
      name: "Admin",
      role: Role.ADMIN,
    },
  });

  const customer = await prisma.user.upsert({
    where: { email: "customer@example.com" },
    update: {},
    create: {
      email: "customer@example.com",
      password: passwordHash,
      name: "Jane Retail",
      role: Role.CUSTOMER,
      payment: "Credit Card",
      address1: "123 Main St",
      city: "Springfield",
      state: "IL",
      zip: "62701",
      cardLast4: "4242",
    },
  });

  const b2b = await prisma.user.upsert({
    where: { email: "b2b@fleet.com" },
    update: {},
    create: {
      email: "b2b@fleet.com",
      password: passwordHash,
      name: "Fleet Motors B2B",
      role: Role.B2B,
      payment: "Invoice",
      address1: "500 Industrial Blvd",
      city: "Chicago",
      state: "IL",
      zip: "60601",
    },
  });

  const items = await Promise.all([
    prisma.item.upsert({
      where: { id: 1 },
      update: {},
      create: {
        name: "2021 Kia K5",
        category: "Sedan",
        price: 24999,
        description: "Sporty midsize sedan with modern tech and comfort.",
        image: "/images/12255-2021-kia-k5.webp",
      },
    }),
    prisma.item.upsert({
      where: { id: 2 },
      update: {},
      create: {
        name: "BMW M5",
        category: "Sports",
        price: 103500,
        description: "High-performance luxury sports sedan.",
        image: "/images/BMW-M5-PNG-HD.png",
      },
    }),
    prisma.item.upsert({
      where: { id: 3 },
      update: {},
      create: {
        name: "Mazda CX-5",
        category: "SUV",
        price: 28990,
        description: "Compact SUV with refined handling and interior.",
        image: "/images/371-3716992_nissan-car-png-2017-cx-5-mazda-cx.png",
      },
    }),
    prisma.item.upsert({
      where: { id: 4 },
      update: {},
      create: {
        name: "Nissan Altima",
        category: "Sedan",
        price: 26500,
        description: "Reliable family sedan with great fuel economy.",
        image: "/images/1.jpeg",
      },
    }),
    prisma.item.upsert({
      where: { id: 5 },
      update: {},
      create: {
        name: "Toyota Camry",
        category: "Sedan",
        price: 27950,
        description: "Best-selling midsize sedan known for dependability.",
        image: "/images/2.png",
      },
    }),
    prisma.item.upsert({
      where: { id: 6 },
      update: {},
      create: {
        name: "Honda CR-V",
        category: "SUV",
        price: 31200,
        description: "Versatile compact SUV with spacious cargo area.",
        image: "/images/3.png",
      },
    }),
    prisma.item.upsert({
      where: { id: 7 },
      update: {},
      create: {
        name: "Ford F-150",
        category: "Truck",
        price: 45200,
        description: "America's best-selling pickup truck.",
        image: "/images/5.png",
      },
    }),
    prisma.item.upsert({
      where: { id: 8 },
      update: {},
      create: {
        name: "Chevrolet Corvette",
        category: "Sports",
        price: 68900,
        description: "Iconic American sports car.",
        image: "/images/6.webp",
      },
    }),
  ]);

  await prisma.itemMoreData.upsert({
    where: { itemId: items[0].id },
    update: {},
    create: {
      itemId: items[0].id,
      detail1: "2.5L Turbo I4",
      detail2: "8-speed automatic",
      detail3: "Front-wheel drive",
      detail4: "Leather seats",
      detail5: "Apple CarPlay / Android Auto",
      detail6: "Lane keep assist",
      photo1: "/images/12255-2021-kia-k5.webp",
    },
  });

  await prisma.itemMoreData.upsert({
    where: { itemId: items[1].id },
    update: {},
    create: {
      itemId: items[1].id,
      detail1: "4.4L Twin-Turbo V8",
      detail2: "617 hp",
      detail3: "AWD xDrive",
      detail4: "M Sport exhaust",
      detail5: "Carbon roof",
      detail6: "Executive package",
      photo1: "/images/BMW-M5-PNG-HD.png",
      photo2: "/images/BMW-M5-PNG-Free-File-Download.png",
    },
  });

  const order = await prisma.order.create({
    data: {
      userId: customer.id,
      items: {
        create: [
          {
            itemId: items[0].id,
            name: items[0].name,
            quantity: 1,
            unitPrice: items[0].price,
          },
        ],
      },
    },
  });

  console.log("Seed complete:", {
    admin: admin.email,
    customer: customer.email,
    b2b: b2b.email,
    items: items.length,
    orderId: order.id,
  });
}

main()
  .catch((e) => {
    console.error(e);
    process.exit(1);
  })
  .finally(() => prisma.$disconnect());
