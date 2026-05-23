export type CartLine = {
  itemId: number;
  name: string;
  price: number;
  quantity: number;
  image: string | null;
};

export function cartTotal(lines: CartLine[]) {
  return lines.reduce((sum, line) => sum + line.price * line.quantity, 0);
}

export function cartCount(lines: CartLine[]) {
  return lines.reduce((sum, line) => sum + line.quantity, 0);
}
