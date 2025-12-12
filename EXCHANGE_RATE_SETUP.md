# Hướng dẫn Setup Exchange Rate API

## Tổng quan

Hệ thống đã được tích hợp với Exchange Rate API để tự động cập nhật tỷ giá VND/USD thay vì sử dụng giá trị cố định. Hệ thống hỗ trợ 2 API miễn phí:

1. **ExchangeRate-API.com** (Khuyến nghị)
   - Free tier: 1,500 requests/tháng
   - Có thể sử dụng không cần API key (giới hạn)
   - Hoặc đăng ký API key để có nhiều requests hơn

2. **exchangerate.host** (Fallback)
   - Hoàn toàn miễn phí, không cần API key
   - Không giới hạn requests
   - Sử dụng làm fallback nếu API chính thất bại

## Cấu hình

### 1. Cấu hình trong file `.env`

Thêm các dòng sau vào file `.env`:

```env
# Exchange Rate API Configuration
EXCHANGE_RATE_API_ENABLED=true
EXCHANGE_RATE_API_KEY=your_api_key_here
EXCHANGE_RATE_CACHE_DURATION=3600

# Fallback rate (sử dụng nếu API thất bại)
STRIPE_VND_TO_USD_RATE=25000
```

**Giải thích:**
- `EXCHANGE_RATE_API_ENABLED`: Bật/tắt việc lấy tỷ giá từ API (mặc định: `true`)
- `EXCHANGE_RATE_API_KEY`: API key từ ExchangeRate-API.com (tùy chọn, có thể để trống)
- `EXCHANGE_RATE_CACHE_DURATION`: Thời gian cache tỷ giá (giây), mặc định 1 giờ (3600)
- `STRIPE_VND_TO_USD_RATE`: Tỷ giá fallback nếu API thất bại (mặc định: 25000)

### 2. Đăng ký API Key (Tùy chọn)

Nếu muốn sử dụng ExchangeRate-API.com với API key:

1. Truy cập: https://www.exchangerate-api.com/
2. Đăng ký tài khoản miễn phí
3. Lấy API key từ dashboard
4. Thêm vào `.env`: `EXCHANGE_RATE_API_KEY=your_api_key_here`

**Lưu ý:** Không bắt buộc phải có API key. Hệ thống vẫn hoạt động được mà không cần API key, nhưng sẽ có giới hạn requests.

## Cách hoạt động

1. **Lấy tỷ giá từ API:**
   - Hệ thống sẽ gọi API để lấy tỷ giá VND/USD mới nhất
   - Tỷ giá được cache trong 1 giờ để tránh gọi API quá nhiều
   - Nếu API thất bại, sẽ tự động fallback sang API thứ 2

2. **Fallback:**
   - Nếu cả 2 API đều thất bại, hệ thống sẽ sử dụng giá trị từ `STRIPE_VND_TO_USD_RATE` trong config
   - Đảm bảo hệ thống luôn hoạt động ngay cả khi API không khả dụng

3. **Cache:**
   - Tỷ giá được cache trong 1 giờ (có thể cấu hình)
   - Giúp giảm số lượng requests đến API
   - Có thể clear cache bằng cách: `php artisan cache:clear`

## Sử dụng trong Code

### Trong Controller:

```php
use App\Services\ExchangeRateService;

// Lấy tỷ giá
$exchangeRate = ExchangeRateService::getRate();

// Hoặc với fallback
$exchangeRate = config('services.exchange_rate.enabled', true)
    ? ExchangeRateService::getRate()
    : config('services.stripe.vnd_to_usd_rate', 25000);
```

### Clear Cache:

```php
use App\Services\ExchangeRateService;

// Clear cache để lấy tỷ giá mới
ExchangeRateService::clearCache();
```

## Testing

Để test xem API có hoạt động không:

```bash
php artisan tinker
```

Sau đó chạy:

```php
use App\Services\ExchangeRateService;

// Lấy tỷ giá
$rate = ExchangeRateService::getRate();
echo "Current VND/USD rate: " . $rate . "\n";
```

## Troubleshooting

### API không hoạt động

1. **Kiểm tra kết nối internet:**
   - Đảm bảo server có kết nối internet
   - Kiểm tra firewall có chặn requests không

2. **Kiểm tra logs:**
   - Xem file `storage/logs/laravel.log`
   - Tìm các lỗi liên quan đến Exchange Rate API

3. **Kiểm tra cấu hình:**
   - Đảm bảo `EXCHANGE_RATE_API_ENABLED=true` trong `.env`
   - Chạy `php artisan config:clear` sau khi thay đổi `.env`

4. **Test API trực tiếp:**
   ```bash
   curl https://api.exchangerate.host/latest?base=USD&symbols=VND
   ```

### Tỷ giá không cập nhật

1. **Clear cache:**
   ```bash
   php artisan cache:clear
   ```

2. **Kiểm tra cache duration:**
   - Mặc định cache 1 giờ
   - Có thể giảm `EXCHANGE_RATE_CACHE_DURATION` để cập nhật thường xuyên hơn

### Muốn tắt API và dùng tỷ giá cố định

Thêm vào `.env`:
```env
EXCHANGE_RATE_API_ENABLED=false
STRIPE_VND_TO_USD_RATE=25000
```

Sau đó chạy:
```bash
php artisan config:clear
```

## Lưu ý

1. **Rate Limits:**
   - ExchangeRate-API.com free tier: 1,500 requests/tháng
   - exchangerate.host: Không giới hạn nhưng có thể bị rate limit nếu gọi quá nhiều
   - Cache giúp giảm số lượng requests

2. **Độ chính xác:**
   - Tỷ giá được cập nhật theo thời gian thực từ API
   - Có thể có độ trễ do cache (mặc định 1 giờ)

3. **Fallback:**
   - Luôn có fallback về giá trị cố định nếu API thất bại
   - Đảm bảo hệ thống luôn hoạt động

4. **Production:**
   - Nên sử dụng API key để có nhiều requests hơn
   - Cân nhắc tăng cache duration để giảm API calls
   - Monitor logs để phát hiện vấn đề sớm


