"use client";

import { DropdownMenuItem } from "@/components/ui/dropdown-menu";
import { signOut } from "next-auth/react";

export function SignOutButton() {
  return (
    <DropdownMenuItem
      className="cursor-pointer"
      onClick={() => signOut({ callbackUrl: "/" })}
    >
      Sign out
    </DropdownMenuItem>
  );
}
