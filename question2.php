<?php
session_start();

// Book Class
class Book {
    private $title;
    private $availableCopies;

    // Constructor to initialize the book title and available copies
    public function __construct($title, $availableCopies) {
        $this->title = $title;
        $this->availableCopies = $availableCopies;
    }

    // Method to borrow a book (decreases available copies)
    public function borrowBook() {
        if ($this->availableCopies > 0) {
            $this->availableCopies--;
            return "Book '{$this->title}' borrowed successfully.";
        } else {
            return "Sorry, no copies of '{$this->title}' are available.";
        }
    }

    // Method to return a book (increases available copies)
    public function returnBook() {
        $this->availableCopies++;
        return "Book '{$this->title}' returned successfully.";
    }

    // Method to get available copies of the book
    public function getAvailableCopies() {
        return $this->availableCopies;
    }

    // Method to get the title of the book
    public function getTitle() {
        return $this->title;
    }
}

// Member Class
class Member {
    private $name;

    // Constructor to initialize member name
    public function __construct($name) {
        $this->name = $name;
    }

    // Method to borrow a book
    public function borrowBook($book) {
        return $book->borrowBook();
    }

    // Method to return a book
    public function returnBook($book) {
        return $book->returnBook();
    }
}

// Initialize session and book objects if not set
if (!isset($_SESSION['books'])) {
    // Create books and store them in session
    $_SESSION['books'] = [
        'book1' => new Book("PHP for Beginners", 3),
        'book2' => new Book("Advanced PHP OOP", 2),
    ];
}

// Create members
$member1 = new Member("Member One");
$member2 = new Member("Member Two");

// Process form submission for borrowing and returning books
$message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Member One borrowing books
    if (isset($_POST['borrowBook1'])) {
        $message = $member1->borrowBook($_SESSION['books']['book1']);
    }
    if (isset($_POST['borrowBook2'])) {
        $message = $member1->borrowBook($_SESSION['books']['book2']);
    }

    // Member Two borrowing books
    if (isset($_POST['borrowBook3'])) {
        $message = $member2->borrowBook($_SESSION['books']['book1']);
    }
    if (isset($_POST['borrowBook4'])) {
        $message = $member2->borrowBook($_SESSION['books']['book2']);
    }

    // Member One returning books
    if (isset($_POST['returnBook1'])) {
        $message = $member1->returnBook($_SESSION['books']['book1']);
    }
    if (isset($_POST['returnBook2'])) {
        $message = $member1->returnBook($_SESSION['books']['book2']);
    }

    // Member Two returning books
    if (isset($_POST['returnBook3'])) {
        $message = $member2->returnBook($_SESSION['books']['book1']);
    }
    if (isset($_POST['returnBook4'])) {
        $message = $member2->returnBook($_SESSION['books']['book2']);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library System</title>
    <style>
        body { font-family: Arial, sans-serif;  }
        form { margin-top: 20px; }
        .message { color: green; margin-top: 20px; }
        .error { color: red; }
        .color{
            font-weight: bolder;
            font-size: x-large;
        }
        input {
            font-weight: bolder;
            background-color: aqua;
        }
    </style>
</head>
<body>

    <h1>Library System</h1>

    <h2>Available Books:</h2>
    <ul>
    <li>Available Copies of 'The Great Gatsby': <?php echo $_SESSION['books']['book1']->getAvailableCopies(); ?></li>
    <li>Available Copies of 'To Kill a Mockingbird': <?php echo $_SESSION['books']['book2']->getAvailableCopies(); ?></li>
    </ul>

    <h2>Borrow Books:</h2>
    <form action="" method="post">
        <h3>Member One:</h3>
        <input type="submit" name="borrowBook1" value="The Great Gatsby">
        <input type="submit" name="borrowBook2" value="To Kill a Mockingbird">

        <h3>Member Two:</h3>
        <input type="submit" name="borrowBook3" value="The Great Gatsby">
        <input type="submit" name="borrowBook4" value="To Kill a Mockingbird">
    </form>

    <h2>Return Books:</h2>
    <form action="" method="post">
        <h3>Member One:</h3>
        <input type="submit" name="returnBook1" value="The Great Gatsby">
        <input type="submit" name="returnBook2" value="To Kill a Mockingbird">

        <h3>Member Two:</h3>
        <input type="submit" name="returnBook3" value="The Great Gatsby">
        <input type="submit" name="returnBook4" value="To Kill a Mockingbird">
    </form>

    <?php if ($message): ?>
        <p class="message"><?php echo $message; ?></p>
    <?php endif; ?>

    <h2>Updated Available Books:</h2>
    <ul>
        <li>Available Copies of 'The Great Gatsby': <?php echo $_SESSION['books']['book1']->getAvailableCopies(); ?></li>
        <li>Available Copies of 'To Kill a Mockingbird': <?php echo $_SESSION['books']['book2']->getAvailableCopies(); ?></li>
        
    </ul>

</body>
</html>
