Для выполнения вашей задачи, где вам нужно каждый день сохранять значение feedbacks для конкретного продукта и впоследствии строить график по этим данным, вам нужно организовать свои сервисы и модели данных немного иначе.

Организация моделей данных
Product: Это основная сущность, представляющая продукт (например, вашу видеокарту GTX 1660).
FeedbackRecord: Это сущность, которая будет хранить информацию о количестве отзывов (feedbacks) для продукта на конкретную дату.
Шаг 1: Определите сущности
Сущность Product
```php
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[Entity(repositoryClass: ProductRepository::class)]
#[Table(name: 'products')]
class Product
{
#[Id]
#[Column(name: 'id', type: 'integer')]
#[GeneratedValue(strategy: 'AUTO')]
private int $id;

    #[Column(name: 'product_name', type: 'string')]
    private string $productName;

    #[OneToMany(targetEntity: FeedbackRecord::class, mappedBy: 'product', cascade: ['persist', 'remove'])]
    private Collection $feedbackRecords;

    #[Column(name: 'created_at', type: 'datetime')]
    private \DateTime $createdAt;

    public function __construct() {
        $this->feedbackRecords = new ArrayCollection();
        $this->createdAt = new \DateTime();
    }

    // Getters and Setters
    public function getId(): int {
        return $this->id;
    }

    public function getProductName(): string {
        return $this->productName;
    }

    public function setProductName(string $productName): void {
        $this->productName = $productName;
    }

    public function getFeedbackRecords(): Collection {
        return $this->feedbackRecords;
    }

    public function addFeedbackRecord(FeedbackRecord $feedbackRecord): void {
        if (!$this->feedbackRecords->contains($feedbackRecord)) {
            $this->feedbackRecords[] = $feedbackRecord;
            $feedbackRecord->setProduct($this);
        }
    }

    public function getCreatedAt(): \DateTime {
        return $this->createdAt;
    }
}
```
Сущность FeedbackRecord
```php
#[Entity(repositoryClass: FeedbackRecordRepository::class)]
#[Table(name: 'feedback_records')]
class FeedbackRecord
{
#[Id]
#[Column(name: 'id', type: 'integer')]
#[GeneratedValue(strategy: 'AUTO')]
private int $id;

    #[ManyToOne(targetEntity: Product::class, inversedBy: 'feedbackRecords')]
    #[JoinColumn(name: 'product_id', referencedColumnName: 'id')]
    private Product $product;

    #[Column(name: 'feedback_count', type: 'integer')]
    private int $feedbackCount;

    #[Column(name: 'record_date', type: 'datetime')]
    private \DateTime $recordDate;

    public function __construct() {
        $this->recordDate = new \DateTime();
    }

    // Getters and Setters
    public function getId(): int {
        return $this->id;
    }

    public function getProduct(): Product {
        return $this->product;
    }

    public function setProduct(Product $product): void {
        $this->product = $product;
    }

    public function getFeedbackCount(): int {
        return $this->feedbackCount;
    }

    public function setFeedbackCount(int $feedbackCount): void {
        $this->feedbackCount = $feedbackCount;
    }

    public function getRecordDate(): \DateTime {
        return $this->recordDate;
    }

    public function setRecordDate(\DateTime $recordDate): void {
        $this->recordDate = $recordDate;
    }
}
```
Шаг 2: Создайте сервисы для управления данными

ProductService
```php
class ProductService
{
private EntityManagerInterface $entityManager;
private ProductRepository $productRepository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->productRepository = $entityManager->getRepository(Product::class);
    }

    public function create(string $productName): Product
    {
        $product = new Product();
        $product->setProductName($productName);

        $this->entityManager->persist($product);
        $this->entityManager->flush();

        return $product;
    }

    public function findByName(string $productName): ?Product
    {
        return $this->productRepository->findOneBy(['productName' => $productName]);
    }
}
```
FeedbackRecordService
```php
class FeedbackRecordService
{
private EntityManagerInterface $entityManager;
private FeedbackRecordRepository $feedbackRecordRepository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->feedbackRecordRepository = $entityManager->getRepository(FeedbackRecord::class);
    }

    public function create(int $feedbackCount, Product $product): FeedbackRecord
    {
        $feedbackRecord = new FeedbackRecord();
        $feedbackRecord->setFeedbackCount($feedbackCount);
        $feedbackRecord->setProduct($product);

        $this->entityManager->persist($feedbackRecord);
        $this->entityManager->flush();

        return $feedbackRecord;
    }

    public function getFeedbacksForProduct(Product $product, \DateTime $from, \DateTime $to): array
    {
        return $this->feedbackRecordRepository->findByProductAndDateRange($product, $from, $to);
    }
}
```
FeedbackRecordRepository
```php
use Doctrine\ORM\EntityRepository;

class FeedbackRecordRepository extends EntityRepository
{
public function findByProductAndDateRange(Product $product, \DateTime $from, \DateTime $to): array
{
$qb = $this->createQueryBuilder('fr');
return $qb->where('fr.product = :product')
->andWhere('fr.recordDate BETWEEN :from AND :to')
->setParameter('product', $product)
->setParameter('from', $from)
->setParameter('to', $to)
->orderBy('fr.recordDate', 'ASC')
->getQuery()
->getResult();
}
}
```
Шаг 3: Используйте сервисы для сохранения и анализа данных

// Пример использования сервисов
```php
$productService = new ProductService($entityManager);
$feedbackRecordService = new FeedbackRecordService($entityManager);

$productName = "GeForce GTX 1660 SUPER VENTUS XS OC 6GB Игровая";
$feedbacksToday = 12;

// Найти или создать продукт
$product = $productService->findByName($productName);
if (!$product) {
$product = $productService->create($productName);
}

// Создать запись о фидбеке
$feedbackRecordService->create($feedbacksToday, $product);

// Пример получения данных о фидбеке за период
$fromDate = new \DateTime('-1 week');
$toDate = new \DateTime();
$feedbackRecords = $feedbackRecordService->getFeedbacksForProduct($product, $fromDate, $toDate);

// Вывод данных о фидбеке
foreach ($feedbackRecords as $record) {
echo $record->getRecordDate()->format('Y-m-d') . ': ' . $record->getFeedbackCount() . " feedbacks\n";
}
```
Заключение
Теперь у вас есть полноценная структура для ежедневного сохранения и последующего анализа данных о количестве отзывов по продуктам. Это позволит вам строить графики и проводить аналитику на основе накопленных данных.