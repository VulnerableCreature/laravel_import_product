# Запуск приложения

> 1. Установка пакетов
```bash
composer instll
```

> 2. Установка npm package
```bash
npm install 
```

> 3. Стартуем базу данных
```bash
docker-compose up -d 
```
> 4. Open browser 
```bash 
http://127.0.0.1:8000
```

# Тестовое задание "Офис"

Основные функции
1.	Страница импорта товаров:
	- Кнопка для загрузки и импорта Excel файла.
	- Парсинг файла и заполнение базы данных.
	- Страница отображения товаров:
	- Отображение всех товаров из базы данных.
2. Структура базы данных
	- Таблица товары:
     	- product_id - идентификатор товара.
     	- name - название товара.
     	- price - цена товара.
     	- discount - скидка на товар.
     	- description - описание товара.
     	- type - тип товара.
     	- external_code - внешний код товара.
     	- barcodes - штрихкоды товара. (их может быть несколько разных типов)
     	- additional_features - дополнительные характеристики.
	- Таблица характеристики:
    	- product_id - идентификатор товара.
  		- key - ключ характеристики.
  		- value - значение характеристики.
  	- Таблица фото:
      - Варианты сохранения фотографий в базе данных и их привязка к товарам.
3. Функция импорта
	- Использование библиотеки Laravel Excel для работы с .xlsx файлами.
	- Импорт новых товаров с учетом их уникальности по внешнему коду и магазину.
	- Автоматическое определение и распознавание столбцов (например, цена, наименование, бренд).
	- Обработка до 5 подряд пустых ячеек.
4. Требования к импортируемым данным
	- Колонки: Категории, Название товара, Бренд, Внешний код, Штрихкоды, Цена продажи, Описание, Фото, - - Характеристики в формате k, v.
5. Страница отображения товаров
	- Разработка страницы для просмотра результатов импорта.
	- Возможность добавления стилей для улучшения визуального представления.
6. Дополнительные замечания
	- Возможность доработки и добавления новых функций по мере необходимости.

# Tasks

- [x] Table `products`
- [x] Table `characteristics`
- [x] Models
- [x] Relations in model
- [x] Table `photo`
- [x] Импорт товаров
- [x] Обработка до 5 пустых ячеек
- [x] Сохранение фото, привязка к товару
- [x] Сохранение характеристик, привязка к товару
- [x] Вывод всех товаров
- [x] Страница импорта
- [x] Просмотр детальной информации о товаре
- [x] Импорт новых товаров с учетом их уникальности по внешнему коду и магазину

# Что делал

## Migration

```bash
php artisan make:model Product -m
```
> Штрихкод. Сделал под каждый код отдельное поле в БД.

> Дополнительные характеристики: пока что идея такая что туда будет записываться какой-то текст, например: хрупкий товар.
Но мне кажется, что нужно выпилить это поле и работать с ними через таблицу `характеристики`.

> Первая миграция
```bash
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */


    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id('product_id);
            $table->text('name')->comment("Название товара");
            $table->float('price', 5, 2)->comment("Цена товара");
            $table->integer('discount')->comment("Скидка на товар");
            $table->text('description')->nullable()->comment("Описание товара [необязательно]");
            $table->string('type')->comment("Тип товара");
            $table->string('external_code', 130)->comment("Внешний код продукта");
            /* -------------------------------------Штрихкод------------------- */
            $table->integer('barcode_ean_thirteen')->nullable()->comment("Штрихкод EAN13 integer");
            $table->string('barcode_ean_eight', 150)->nullable()->comment("Штрихкод EAN8 string");
            $table->text('barcode_code')->nullable()->comment("Штрихкод Code128 text");
            $table->text('barcode_ean_upc')->nullable()->comment("Штрихкод UPC text");
            $table->text('barcode_ean_gtin')->nullable()->comment("Штрихкод GTIN text");
            /* ------------------------------------------------------------------- */
            $table->string('additional_features')->nullable()->comment("Дополнительные характеристики товара");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
```

> Вторая миграция
```bash
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('characteristics', function (Blueprint $table) {
            $table->id();
            /*-----------------Foreign key---------------*/
            $table->integer('product_id')->comment("Внешний ключ для связи с таблицей products");
            $table->index('product_id', 'product_characteristic_idx');
            $table->foreign('product_id', 'product_characteristic_fk')->references('product_id')->on('products')->onDelete('cascade')->onUpdate('cascade');
            /*-------------------------------------------*/
            $table->string('key')->comment("Ключ характеристики");
            $table->string('value')->comment("Значение характеристики");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('characteristics');
    }
};
```

> Третья миграция
```bash
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('table_photo_products', function (Blueprint $table) {
            $table->id();
            /*-----------------Foreign key---------------*/
            $table->integer('product_id')->comment("Внешний ключ для связи с таблицей products");
            $table->index('product_id', 'product_photo_idx');
            $table->foreign('product_id', 'product_photo_fk')->references('product_id')->on('products')->onDelete('cascade')->onUpdate('cascade');
            /*-------------------------------------------*/
            $table->string('path')->comment("Путь к фотографии");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_photo_products');
    }
};
```

## Форма импорта файла

> Важно! Добавить аттрибут к форме `enctype="multipart/form-data"` - забыл!

## Laravel-excel

```bash
composer require maatwebsite/excel
```

### Обработка пустых ячеек

Нашел интересный Event который работает ДО импорта `BeforeImport` по идее с помощью него можно обработать пустые ячейки

Также нашёл функцию для регистрации этого события ` public function registerEvents(): array` 

### Documentation

Для получения общего количества строк в excel необходимо использовать метод `getReader()`. [Link](https://stackoverflow.com/questions/57942366/laravel-excel-get-total-number-of-rows-before-import)
