<p align="center"><a href="https://partssupplier.blacktechcorp.com/" target="_blank"><img src="https://partssupplier.blacktechcorp.com/uploads/website-images/logo-2024-11-10-09-14-52-5175.png" width="400" alt="Laravel Logo"></a></p>


</p>

# Order Management & Payment System

## Overview

This is a Laravel-based Order Management and Payment System that allows users to manage orders and handle payments using multiple methods: **Credit** and **Stripe**. The system supports **partial payments** and tracks the `due_amount` to ensure accurate payment status updates.

---

## Features

- **Order Management**
  - View orders with payment statuses: `due`, `partial`, and `paid`.
  - Dynamic updates of `due_amount` and `payment_method`.

- **Payment Functionality**
  - Credit Payment: Deducts payment from the user's available credit balance.
  - Stripe Payment: Integration for secure online payments.

- **Dynamic Payment Status**
  - Updates `payment_method` to `partial` or `paid` based on the payment amount.
  - Ensures accurate tracking of `due_amount`.

- **Validation**
  - Prevents overpayments or insufficient credit usage.
  - Proper validation of payment amounts.

---

##
Admin / Dashboard 

** There is Dynamic and user friendly admin panel where admin and employee can saw there orders , add product, category, auto order assign option, user add delete and many more

## Requirements

- **PHP**: ^8.0
- **Laravel**: ^9.x or higher
- **Database**: MySQL or compatible
- **Stripe API**: For online payments
- **Composer**: To manage PHP dependencies

---

## Installation

Follow these steps to set up the project on your local environment:

1. **Clone the repository:**
   ```bash
   git clone https://github.com/your-username/your-repository.git
   cd your-repository
