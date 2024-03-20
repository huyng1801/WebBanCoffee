CREATE TABLE categories(
	category_id int AUTO_INCREMENT PRIMARY KEY,
    category_name varchar(50) NOT NULL UNIQUE,
    image text
);
CREATE TABLE products(
	product_id int AUTO_INCREMENT PRIMARY KEY,
    product_name varchar(50) NOT NULL,
    image text,
    price int,
	description text,
    category_id int,
    FOREIGN KEY (category_id) REFERENCES categories(category_id)
);
CREATE TABLE orders(
	order_id int AUTO_INCREMENT PRIMARY KEY,
    date_order date DEFAULT CURRENT_DATE,
    customer_name varchar(50) NOT NULL,
    phone_number varchar(20) NOT NULL,
    email varchar(20) NOT NULL,
    order_status varchar(20) DEFAULT 'Chưa duyệt',
    note text
);
CREATE TABLE order_detail(
	id int AUTO_INCREMENT PRIMARY KEY,
  order_id int,
    product_id int,
    quantity int,
    FOREIGN KEY (order_id) REFERENCES orders(order_id),
    FOREIGN KEY (product_id) REFERENCES products(product_id)
);
CREATE TABLE news(
	new_id int AUTO_INCREMENT PRIMARY KEY,
    title text NOT NULL,
    image text NOT NULL,
    sub_content text,
    content text,
    create_at date DEFAULT CURRENT_DATE
);
CREATE TABLE product_reviews (
    review_id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT,
    customer_name VARCHAR(50) NOT NULL,
    email VARCHAR(50),
    rating INT NOT NULL,
    comment TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(product_id)
);

INSERT INTO categories (category_name, image) VALUES
  ('Cà Phê', 'ca_phe.jpg');
INSERT INTO products (product_name, image, price, description, category_id) VALUES
  ('Cà Phê Arabica', 'ca_phe_arabica.jpg', 10, 'Cà phê Arabica chất lượng cao', 1),
  ('Cà Phê Robusta', 'ca_phe_robusta.jpg', 8, 'Cà phê Robusta đậm đà', 1),
  ('Cà Phê Sạch', 'ca_phe_sach.jpg', 12, 'Cà phê chất lượng cao từ nguồn cung sạch', 1);

INSERT INTO orders (customer_name, phone_number, email, note) VALUES
  ('Nguyễn Văn A', '123-456-7890', 'nguyenvana@example.com', 'Thêm đường nhiều'),
  ('Trần Thị B', '987-654-3210', 'tranthib@example.com', 'Không đường');

INSERT INTO order_detail (order_id, product_id, quantity) VALUES
  (1, 1, 2), 
  (2, 2, 1); 

INSERT INTO news (title, image, sub_content, content) VALUES
  ('Công Bố Dòng Sản Phẩm Cà Phê Mới', 'ca_phe_moi.jpg', 'Khám phá dòng sản phẩm mới của chúng tôi', 'Chúng tôi vô cùng hạnh phúc thông báo về dòng sản phẩm cà phê mới, chăm sóc kỹ lưỡng để mang lại trải nghiệm thú vị cho bạn.');

INSERT INTO product_reviews (product_id, customer_name, email, rating, comment)
VALUES
  (1, 'Nguyễn Văn A', 'nguyen.vana@example.com', 5, 'Sản phẩm tuyệt vời! Rất đáng giá khuyến khích.'),
  (1, 'Trần Thị B', 'tranthib@example.com', 4, 'Chất lượng tốt, nhưng hơi đắt.'),
  (2, 'Lê Minh C', 'leminhc@example.com', 3, 'Cà phê trung bình, có thể cải thiện hơn.'),
  (2, 'Phạm Thị D', 'phamthid@example.com', 5, 'Yêu thích hoàn toàn!'),
  (3, 'Trần Văn E', 'tranvane@example.com', 4, 'Tươi mới và ngon.'),
  (3, 'Lê Thị F', 'lethif@example.com', 5, 'Đáng giá từng đồng.');
