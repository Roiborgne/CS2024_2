<?php
use PHPUnit\Framework\TestCase;
use function App\Fonctions\CalculComplexiteMdp;
class CalculComplexiteMdpTest extends TestCase {
    public function testaubry()
    {
// Arrange
        $mdp = "aubry";
// Act
        $resultat = CalculComplexiteMdp($mdp);
// Assert
        echo $resultat;
        $this->assertEquals(24, $resultat);
    }

    public function testsuperaubry()
    {
// Arrange
        $mdp = "super@ubry";
// Act
        $resultat = CalculComplexiteMdp($mdp);
// Assert
        echo $resultat;
        $this->assertEquals(56, $resultat);
    }

    public function testSuperaubry2022()
    {
// Arrange
        $mdp = "Super@ubry2022";
// Act
        $resultat = CalculComplexiteMdp($mdp);
// Assert
        echo $resultat;
        $this->assertEquals(90, $resultat);

    }
    public function testGiroudPresident2027()
    {
// Arrange
        $mdp = "Giroud-Président||2027";
// Act
        $resultat = CalculComplexiteMdp($mdp);
// Assert
        echo $resultat;
        $this->assertEquals(147, $resultat);

    }
}

