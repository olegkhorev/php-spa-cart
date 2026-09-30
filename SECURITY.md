# Security Policy

## Patched Vulnerabilities
The following historical security vulnerabilities have been formally patched and resolved in this repository:

* **CVE-2023-4547** - Reflected Cross-Site Scripting (XSS) via brandid/price filters (FIXED).
* **CVE-2023-4548** - SQL Injection vulnerability via brandid filter (FIXED).
* **CVE-2024-58304** - Stored Cross-Site Scripting (XSS) via product description (FIXED).
* **EDB-ID-51919** - Stored XSS was listed by mistake, because the Admin area was hosted on the same folder as the customer area. Admin should be able to use the WYSIWYG editor.
* **CVE-2023-43149** - A high-severity CSRF flaw (CVSS score 8.8) that allows a remote attacker to silently inject a root administrative user account into the database.
* **CVE-2023-43148** - Another CSRF exploit that allows a remote attacker to completely wipe out all accounts on the platform.
* **VDB-238058** - Reflected Cross-Site Scripting / XSS
* **CVE-2024-6129** - Fixed
* **CVE-2024-6128** - Fixed

Please ensure you are using the latest main branch of this repository to maintain a secure environment.

Versions 1.9.0.3 and below are vulnerabled. Please upgrade to version 2.0.0 where all have been applied.
