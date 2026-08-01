# Bank Tracker (Personal Debit/Credit + Loan Tracker)

Ye files aap apne existing Laravel project mein copy kar ke use kar sakte hain, ya naya project bana kar inhe merge kar lein.

## Kya cover hai

1. **Transactions** — Debit (paisa gaya) / Credit (paisa aya), dashboard par total balance.
2. **Lenders** — Wo log jin se aap ne loan liya.
3. **Loans** — Kitna loan kis se liya, kab liya.
4. **Loan Payments** — Loan par jo bhi amount pay kiya, us se "remaining amount" khud-ba-khud calculate hota hai (Loan Amount - Sum of Payments).

Sab kuch **Repository Pattern** ke sath likha gaya hai (aap ka usual style): Model → Repository Interface → Repository Implementation → Controller.

## Setup Steps

1. Naya Laravel project banayein (agar already nahi hai):
   ```bash
   composer create-project laravel/laravel bank-tracker
   ```

2. Yajra DataTables package install karein:
   ```bash
   composer require yajra/datatables-html
   php artisan vendor:publish --tag=datatables
   ```

3. Is zip ki files apne project mein copy karein (same folder structure maintain karein):
   - `app/Models/*`
   - `app/Repositories/*`
   - `app/Providers/RepositoryServiceProvider.php`
   - `app/Http/Controllers/*`
   - `app/DataTables/*`
   - `database/migrations/*`
   - `routes/web.php` (existing route file ke content ko merge/replace karein)
   - `resources/views/*`

4. `RepositoryServiceProvider` ko register karein:
   - **Laravel 11+**: `bootstrap/providers.php` mein add karein:
     ```php
     return [
         App\Providers\AppServiceProvider::class,
         App\Providers\RepositoryServiceProvider::class,
     ];
     ```
   - **Laravel 10 ya usse pehle**: `config/app.php` ke `providers` array mein add karein.

5. `.env` mein apni database configure karein, phir migrations chalayein:
   ```bash
   php artisan migrate
   ```

6. Server start karein:
   ```bash
   php artisan serve
   ```

7. Browser mein `http://127.0.0.1:8000` open karein — Dashboard, Transactions, Lenders, aur Loans sab wahan milenge.

## Kaise use karna hai

- Pehle **Lenders** mein wo banda add karein jis se loan liya (e.g. "Ali", "Ahmed Bhai").
- Phir **Loans** mein us lender ke against loan amount add karein.
- Jab bhi loan ka kuch amount wapis karein, Loan ke **show/detail page** par "Add Payment" form se entry karein — remaining amount khud update ho jayega.
- **Transactions** section apne bank/cash ke debit-credit (income/expense) track karne ke liye hai, loans se independent.
- **Dashboard** par total credit, total debit, balance, aur loans ka overall summary milega.

## Lender Personal Details

Lenders ki personal details (CNIC, Address, Email, City, Relationship) ek separate table `lender_details` mein store hoti hain. `lenders` table mein `lender_detail_id` column hai jo `lender_details.id` ko reference karta hai (as requested). Lender add/edit karte waqt dono forms ek hi page par hain — save karte waqt pehle detail record banta/update hota hai, phir uski id lender ke sath link hoti hai.

## Notes

- Auth intentionally add nahi kiya (aap ne single-user, bina auth ke bola tha). Agar baad mein multi-user karna ho to Sanctum/Fortify add kar ke sab tables mein `user_id` add karna hoga.
- Yajra DataTables sirf Transactions aur Loans list ke liye use hua hai (jahan records zyada ho sakte hain). Lenders list simple table hai kyunke wo usually kam hoti hai.
