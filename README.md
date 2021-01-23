# Passwordless

Simple login without password

## Fredric instruktion

1. Användare går till webbsida som visar formulär. Formulär innehåller bara
   fält för email.

2. När användaren skickar iväg sin email i formuläret skapas en kod på
   servern som agerar tillfälligt lösenord. Detta lösenord skickas I
   KLARTEXT till användarens email. Lösenordet är varar i ca 2 min.

3. Två alternativ

- A) Samtidigt omdirigeras användare till nytt fönster där kod skall skrivas
  in.
- B) Email kan också innehålla länk som måste klickas på.

4. Kod sparas i session-variabel kopplat till emailadress, tid.

5. När koden skall verifieras så jämförs koden med den i vår
   session-variabel. Där kollas också att tiden stämmer.

6. Om allt går bra kan vi på något sätt låta användare vara inloggad i
   systemet. T ex med sessions.
