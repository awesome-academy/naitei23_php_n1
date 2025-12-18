<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Về Laravel

Laravel là một framework web với cú pháp rõ ràng và thanh lịch. Chúng tôi tin rằng phát triển phải là một trải nghiệm thú vị và sáng tạo. Laravel giúp việc phát triển trở nên dễ dàng hơn bằng cách đơn giản hóa các tác vụ thường dùng trong nhiều dự án web, chẳng hạn như:

- [Hệ thống routing đơn giản, nhanh chóng](https://laravel.com/docs/routing).
- [Container dependency injection mạnh mẽ](https://laravel.com/docs/container).
- Nhiều backend cho [session](https://laravel.com/docs/session) và [cache](https://laravel.com/docs/cache).
- [ORM database](https://laravel.com/docs/eloquent) trực quan, dễ hiểu.
- [Schema migrations](https://laravel.com/docs/migrations) độc lập với database.
- [Xử lý background job](https://laravel.com/docs/queues) mạnh mẽ.
- [Broadcasting sự kiện real-time](https://laravel.com/docs/broadcasting).

Laravel dễ tiếp cận, mạnh mẽ và cung cấp các công cụ cần thiết cho các ứng dụng lớn, phức tạp.

## Hệ Thống Đặt Tour

Đây là hệ thống đặt tour dựa trên Laravel với xác thực toàn diện, kiểm soát truy cập dựa trên vai trò (RBAC), và các tính năng quản lý tour.

### Tính Năng

- **Xác Thực & Phân Quyền:**
  - Đăng ký, đăng nhập, đăng xuất bằng email/mật khẩu
  - Đặt lại mật khẩu qua email sử dụng [Mailtrap](https://mailtrap.io/) để test an toàn ở môi trường local
  - Xác nhận mật khẩu và cập nhật mật khẩu
  - Kiểm soát truy cập dựa trên vai trò (Admin, Customer)
  - Hệ thống quản lý quyền

- **Quản Lý Tour:**
  - Quản lý danh mục
  - Tour với lịch trình, giá cả và tình trạng có sẵn
  - Hệ thống đặt tour với theo dõi thanh toán
  - Đánh giá và bình luận
  - Chức năng thích

- **Quản Lý Người Dùng:**
  - Quản lý hồ sơ (tên, email, cập nhật mật khẩu)
  - Tự xóa tài khoản
  - Quản lý tài khoản ngân hàng của người dùng
  - Dữ liệu session lưu trong database để cải thiện khả năng quan sát và bảo mật

## Yêu Cầu Hệ Thống

- **PHP:** >= 8.1
- **Composer:** Phiên bản mới nhất
- **Node.js:** >= 16.x và npm
- **MySQL:** >= 5.7 hoặc MariaDB >= 10.3
- **Web Server:** Apache/Nginx (hoặc sử dụng `php artisan serve`)

## Cài Đặt & Thiết Lập

### 1. Clone repository

```bash
git clone <repository-url>
cd naitei23_php_n1
```

### 2. Cài đặt PHP dependencies

```bash
composer install
```

### 3. Cài đặt Node.js dependencies

```bash
npm install
```

### 4. Cấu hình môi trường

Sao chép file `.env.example` thành `.env` (nếu chưa có):

```bash
cp .env.example .env
```

Tạo application key:

```bash
php artisan key:generate
```

### 5. Cấu hình file `.env`

Cập nhật các biến sau trong file `.env` của bạn:

#### Cài Đặt Ứng Dụng
```env
APP_NAME="Tour Booking System"
APP_ENV=local
APP_KEY=base64:... (được tạo bởi key:generate)
APP_DEBUG=true
APP_URL=http://localhost
```

#### Cấu Hình Database
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tour_booking_db
DB_USERNAME=root
DB_PASSWORD=
```

**Lưu ý:** Tạo database trong phpMyAdmin hoặc MySQL trước khi chạy migrations:
- Tên database: `tour_booking_db` (hoặc tên bạn muốn)
- Collation: `utf8mb4_unicode_ci`

#### Cấu Hình Mail (Mailtrap cho Development)

1. Đăng ký tài khoản miễn phí tại [Mailtrap](https://mailtrap.io/)
2. Tạo inbox và lấy thông tin SMTP credentials
3. Cập nhật file `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your-mailtrap-username
MAIL_PASSWORD=your-mailtrap-password
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="no-reply@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

#### Cấu Hình Session
```env
SESSION_DRIVER=database
SESSION_LIFETIME=120
```

#### Cấu Hình Cache & Queue
```env
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
FILESYSTEM_DRIVER=local
```

### 6. Chạy Database Migrations

```bash
php artisan migrate
```

Lệnh này sẽ tạo tất cả các bảng cần thiết bao gồm:
- Users, roles, permissions
- Categories, tours, tour schedules
- Bookings, payments
- Reviews, comments, likes
- User bank accounts
- Sessions table

### 7. Seed Database (Tùy chọn nhưng khuyến nghị)

Chạy seeders để tạo dữ liệu ban đầu:

```bash
php artisan db:seed
```

Lệnh này sẽ tạo:
- **Roles:** Admin, Customer
- **Permissions:** Các quyền khác nhau cho quản lý tour và người dùng
- **Users:**
  - Admin: `admin.account@sun-asterisk.com` / `admin123`
  - Customer: `customer@example.com` / `password`
- **Categories:** Các danh mục tour mẫu

### 8. Build Frontend Assets

Cho môi trường development:

```bash
npm run dev
```

Cho môi trường production:

```bash
npm run build
```

### 9. Khởi Động Development Servers

**Terminal 1 - Laravel Server:**
```bash
php artisan serve
```

**Terminal 2 - Vite Dev Server (nếu sử dụng `npm run dev`):**
```bash
npm run dev
```

Ứng dụng sẽ có sẵn tại: `http://localhost:8000`

## Tài Khoản Mặc Định

Sau khi chạy seeders, bạn có thể đăng nhập với:

**Tài Khoản Admin:**
- Email: `admin.account@sun-asterisk.com`
- Mật khẩu: `admin123`

**Tài Khoản Customer:**
- Email: `customer@example.com`
- Mật khẩu: `password`

## Cấu Trúc Dự Án

```
app/
├── Http/Controllers/
│   ├── Auth/          # Controllers xác thực
│   └── Api/           # API controllers
├── Models/            # Eloquent models
└── Providers/        # Service providers

database/
├── migrations/        # Database migrations
└── seeders/          # Database seeders

resources/
├── views/            # Blade templates
├── css/              # Stylesheets
└── js/               # JavaScript files

routes/
├── web.php           # Web routes
├── api.php           # API routes
└── auth.php          # Authentication routes
```

## Các Lệnh Thường Dùng

```bash
# Chạy migrations
php artisan migrate

# Chạy migrations với seeders
php artisan migrate:fresh --seed

# Xóa cache cấu hình
php artisan config:clear

# Xóa tất cả cache
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# Chạy tests
php artisan test
```

## Xử Lý Sự Cố

### Lỗi Kết Nối Database
- Đảm bảo MySQL/MariaDB đang chạy
- Kiểm tra thông tin đăng nhập database trong `.env`
- Tạo database nếu chưa tồn tại

### Mail Không Gửi Được
- Kiểm tra thông tin Mailtrap trong `.env`
- Xác minh Mailtrap inbox đang hoạt động
- Kiểm tra `storage/logs/laravel.log` để xem lỗi

### Assets Không Tải
- Chạy `npm install` để cài đặt dependencies
- Chạy `npm run dev` hoặc `npm run build`
- Xóa cache trình duyệt

### Lỗi Phân Quyền (Linux/Mac)
```bash
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

Người dùng có thể quản lý hồ sơ tại `/profile`, trong khi quản trị viên có thể sử dụng cùng giao diện để cập nhật thông tin của họ.

## Học Laravel

Laravel có [tài liệu](https://laravel.com/docs) và thư viện video hướng dẫn toàn diện nhất trong tất cả các framework web hiện đại, giúp bạn dễ dàng bắt đầu với framework này.

Nếu bạn không muốn đọc, [Laracasts](https://laracasts.com) có thể giúp bạn. Laracasts chứa hơn 1500 video hướng dẫn về nhiều chủ đề bao gồm Laravel, PHP hiện đại, unit testing, và JavaScript. Nâng cao kỹ năng của bạn bằng cách khám phá thư viện video toàn diện của chúng tôi.

## Nhà Tài Trợ Laravel

Chúng tôi muốn gửi lời cảm ơn đến các nhà tài trợ sau đây đã tài trợ cho việc phát triển Laravel. Nếu bạn quan tâm đến việc trở thành nhà tài trợ, vui lòng truy cập [trang Patreon của Laravel](https://patreon.com/taylorotwell).

### Đối Tác Cao Cấp

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Đóng Góp

Cảm ơn bạn đã cân nhắc đóng góp cho framework Laravel! Hướng dẫn đóng góp có thể được tìm thấy trong [tài liệu Laravel](https://laravel.com/docs/contributions).

## Quy Tắc Ứng Xử

Để đảm bảo rằng cộng đồng Laravel chào đón tất cả mọi người, vui lòng xem xét và tuân thủ [Quy Tắc Ứng Xử](https://laravel.com/docs/contributions#code-of-conduct).

## Lỗ Hổng Bảo Mật

Nếu bạn phát hiện lỗ hổng bảo mật trong Laravel, vui lòng gửi email cho Taylor Otwell qua [taylor@laravel.com](mailto:taylor@laravel.com). Tất cả các lỗ hổng bảo mật sẽ được xử lý kịp thời.

## Giấy Phép

Framework Laravel là phần mềm mã nguồn mở được cấp phép theo [giấy phép MIT](https://opensource.org/licenses/MIT).

## Lấy API Keys và thiết lập dịch vụ bên thứ ba

Hướng dẫn ngắn cho đồng nghiệp để lấy các API keys phổ biến cần cho dự án.

- Facebook (Login / Social):
  1. Truy cập https://developers.facebook.com/ và đăng nhập.
  2. Tạo App mới (My Apps → Create App) và chọn loại ứng dụng phù hợp.
  3. Trong App Dashboard, thêm sản phẩm Facebook Login, cấu hình OAuth redirect (ví dụ: `http://localhost/auth/facebook/callback`).
  4. Lấy `App ID` và `App Secret` → điền vào `FACEBOOK_CLIENT_ID` / `FACEBOOK_CLIENT_SECRET` trong `.env`.
  5. Tài liệu: https://developers.facebook.com/docs/facebook-login/

- Google (OAuth 2.0):
  1. Vào Google Cloud Console: https://console.developers.google.com/
  2. Tạo Project hoặc chọn project hiện có.
  3. Bật API cần thiết và tạo Credentials → OAuth 2.0 Client IDs.
  4. Đặt Authorized redirect URIs (ví dụ `http://localhost/auth/google/callback`).
  5. Lấy `Client ID` và `Client Secret` → điền vào `GOOGLE_CLIENT_ID` / `GOOGLE_CLIENT_SECRET`.
  6. Tài liệu: https://developers.google.com/identity/protocols/oauth2

- AWS (S3 và SES):
  1. Sign in to AWS Console: https://console.aws.amazon.com/
  2. Tạo IAM user dành cho ứng dụng (IAM → Users → Add user) với programmatic access.
     - Gán quyền tối thiểu: ví dụ `AmazonS3FullAccess` (hoặc custom policy cho bucket cụ thể) và `AmazonSESFullAccess` nếu cần gửi mail.
     - Sau khi tạo, lưu `Access Key ID` và `Secret Access Key` → điền vào `AWS_ACCESS_KEY_ID` / `AWS_SECRET_ACCESS_KEY`.
  3. S3: tạo bucket (S3 → Create bucket), cấu hình region và quyền.
     - Tài liệu: https://docs.aws.amazon.com/AmazonS3/latest/userguide/create-bucket-overview.html
  4. SES: verify domain hoặc email trước khi gửi mail.
     - Tài liệu SES setup: https://docs.aws.amazon.com/ses/latest/DeveloperGuide/setting-up.html

- Lưu ý bảo mật cho AWS keys:
  - Không sử dụng root account keys.
  - Tạo IAM user với quyền tối thiểu cần thiết.
  - Nếu có thể, dùng IAM Roles trên server thay vì lưu keys cứng.

## Hướng dẫn các bước nhanh (migrate / seed / factory)

1. Copy file môi trường và tạo app key:

```bash
cp .env.example .env
php artisan key:generate
```

2. Cập nhật các biến môi trường (DB, MAIL, AWS, OAuth) trong `.env`.

3. Chạy migration và seed dữ liệu mẫu:

```bash
php artisan migrate
# Hoặc chạy sạch + seed (development)
php artisan migrate:fresh --seed
```

4. Nếu cần chạy seeders/factories cụ thể:

```bash
php artisan db:seed --class=SpecificSeederClass
```

5. Chạy server:

```bash
php artisan serve
npm run dev
```

## Ghi chú bảo mật

- Tuyệt đối không commit file `.env` chứa secrets vào Git.
- Sử dụng `.env.example` (có trong repo) để chia sẻ cấu hình mẫu.
- Đối với AWS, tạo IAM user riêng với quyền tối thiểu; kiểm soát ai có access key.
