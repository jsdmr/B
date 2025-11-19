CREATE TABLE exhibits (
    id INT AUTO_INCREMENT PRIMARY KEY,
    short_title VARCHAR(255) NOT NULL,
    full_title VARCHAR(255) NOT NULL,
    author VARCHAR(255) NOT NULL,
    category VARCHAR(255) NOT NULL,
    year_created VARCHAR(20) NOT NULL,
    country VARCHAR(120) NOT NULL,
    main_image VARCHAR(255) NOT NULL,
    description TEXT,
    is_featured TINYINT(1) DEFAULT 0
);

CREATE TABLE exhibit_images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    exhibit_id INT NOT NULL,
    image_url VARCHAR(255) NOT NULL,
    FOREIGN KEY (exhibit_id) REFERENCES exhibits(id) ON DELETE CASCADE
);

CREATE TABLE exhibit_links (
    id INT AUTO_INCREMENT PRIMARY KEY,
    exhibit_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    url VARCHAR(255) NOT NULL,
    FOREIGN KEY (exhibit_id) REFERENCES exhibits(id) ON DELETE CASCADE
);

CREATE TABLE visit_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    visit_date DATE NOT NULL,
    visit_time TIME NOT NULL,
    name VARCHAR(120) NOT NULL,
    whatsapp VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE facts_posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL
);

INSERT INTO exhibits (short_title, full_title, author, category, year_created, country, main_image, description, is_featured) VALUES
('Зимний закат', 'Зимний закат над Исетью', 'Николай Ростовцев', 'Русское искусство', '1898', 'Россия', 'https://images.unsplash.com/photo-1487412720507-e7ab37603c6f?auto=format&fit=crop&w=800&q=80', 'Лирический пейзаж уральского художника.', 1),
('Рабочий полдень', 'Рабочий полдень на заводе', 'Александр Дейнека', 'Советское искусство', '1935', 'СССР', 'https://images.unsplash.com/photo-1493663284031-b7e3aefcae8e?auto=format&fit=crop&w=800&q=80', 'Динамичная композиция о силе труда.', 1),
('Итальянский дворик', 'Итальянский дворик во Флоренции', 'Луиджи Россо', 'Западная Европа', '1720', 'Италия', 'https://images.unsplash.com/photo-1470071459604-3b5ec3a7fe05?auto=format&fit=crop&w=800&q=80', 'Раннее барокко, детали дворцовой жизни.', 1),
('Фарфоровая чайка', 'Скульптура «Фарфоровая чайка»', 'Завод Гарднера', 'Фарфор', '1905', 'Россия', 'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=800&q=80', 'Редкая работа мастерской Гарднера.', 1),
('Орнаментальный сундук', 'Орнаментальный сундук мастера Еремеева', 'Степан Еремеев', 'Декоративно-прикладное искусство Урала', '1880', 'Россия', 'https://images.unsplash.com/photo-1465311440653-ba9b1d68da18?auto=format&fit=crop&w=800&q=80', 'Расписная утварь с уникальным орнаментом.', 1),
('Путешественники', 'Путешественники в пустыне', 'Ахмад аль-Фараджи', 'Искусство Востока', '1850', 'Марокко', 'https://images.unsplash.com/photo-1529429617124-aee711a70412?auto=format&fit=crop&w=800&q=80', 'Песчаные дюны и караван торговцев.', 1),
('Город-свет', 'Город-свет. Светодиодная инсталляция', 'Елена Сокол', 'Современное искусство', '2021', 'Россия', 'https://images.unsplash.com/photo-1529429617124-aee711a70412?auto=format&fit=crop&w=800&q=80', 'Интерактивный объект о жизни мегаполиса.', 0);

INSERT INTO exhibit_images (exhibit_id, image_url) VALUES
(1, 'https://images.unsplash.com/photo-1500534314209-a25ddb2bd429?auto=format&fit=crop&w=800&q=80'),
(1, 'https://images.unsplash.com/photo-1465311440653-ba9b1d68da18?auto=format&fit=crop&w=800&q=80'),
(2, 'https://images.unsplash.com/photo-1493663284031-b7e3aefcae8e?auto=format&fit=crop&w=800&q=80'),
(3, 'https://images.unsplash.com/photo-1470071459604-3b5ec3a7fe05?auto=format&fit=crop&w=800&q=80');

INSERT INTO exhibit_links (exhibit_id, title, url) VALUES
(1, 'Каталог выставки', 'https://example.com/catalog1'),
(2, 'Статья в журнале «Искусство»', 'https://example.com/article'),
(3, 'Виртуальный тур по залу', 'https://example.com/tour');

INSERT INTO facts_posts (title, content) VALUES
('Факты о коллекции', 'Первый экспонат музея был приобретен на средства промышленников.
В фондах хранится более 200 произведений уральской школы живописи.
Каждый месяц реставраторы обновляют до 15 предметов.
В экспозиции представлены работы художниц XX века, ранее не выставлявшиеся.');
