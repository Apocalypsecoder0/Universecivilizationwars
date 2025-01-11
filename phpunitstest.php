use PHPUnit\Framework\TestCase;

class UserTest extends TestCase {
    public function testPasswordHashing() {
        $password = "securePassword";
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $this->assertTrue(password_verify($password, $hashed));
    }
}
