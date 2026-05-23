import { Gauge, Settings2, Shield } from "lucide-react";

const icons = [Gauge, Settings2, Shield, Gauge, Settings2, Shield];

export function ProductSpecs({ details }: { details: string[] }) {
  if (details.length === 0) return null;

  return (
    <div className="mt-8">
      <h2 className="font-heading text-xl font-semibold">Specifications</h2>
      <ul className="mt-4 grid gap-3 sm:grid-cols-2">
        {details.map((detail, i) => {
          const Icon = icons[i % icons.length];
          return (
            <li
              key={detail}
              className="flex items-start gap-3 rounded-lg border border-border bg-card p-4"
            >
              <Icon className="mt-0.5 h-5 w-5 shrink-0 text-primary" />
              <span className="text-sm">{detail}</span>
            </li>
          );
        })}
      </ul>
    </div>
  );
}
