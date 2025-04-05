Đây là bài test shopify
stack backend: laravel

**Database:**

**stores:**
- id
- title
- access_token

P/S: xài lưu trữ access_token của store sau quá trình authen

**track_events**
- id
- action
- shop
- event_id
- data

P/S: xài lưu trữ lại các event

Ảnh các event:
![image](https://github.com/user-attachments/assets/30c60d6e-2248-4114-bb29-ee8fac495833)

Các Feature chính của ứng dụng:
- authen: get access token, lưu store info
- subscription webhook: xài để nhận dữ liệu từ webhook ( chưa lưu db chỉ hiển thị dữ liệu trả về )
- active webpixel extension: active web expixel
- hứng event bắn về và lưu database

Ứng dụng đã cài đặt:
- theme extensions: bắn action click vào 1 button hoặc reload page
- webpixel extension: bắn action add_to_cart
  
