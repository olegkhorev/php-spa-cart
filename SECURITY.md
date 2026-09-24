# Security Policy

## Patched Vulnerabilities
The following historical security vulnerabilities have been formally patched and resolved in this repository:

* **CVE-2023-4547** - Reflected Cross-Site Scripting (XSS) via brandid/price filters (FIXED).
* **CVE-2023-4548** - SQL Injection vulnerability via brandid filter (FIXED).
* **CVE-2024-58304** - Stored Cross-Site Scripting (XSS) via product description (FIXED).

Please ensure you are using the latest main branch of this repository to maintain a secure environment.

Versions 1.9.0.3 and below are vulnerable to XSS. Please upgrade to version 2.0.0 or later where input sanitization has been applied to the product description fields.
