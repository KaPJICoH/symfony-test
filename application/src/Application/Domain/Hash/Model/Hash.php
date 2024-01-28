<?php

namespace App\Application\Domain\Hash\Model;

use App\Application\Domain\Hash\Enum\Algorithm;
use App\Application\Domain\Hash\Repository\HashRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HashRepository::class)]
#[ORM\Index(columns: ["result", "algorithm"], name: "result_algorithm_idx")]
class Hash
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?Algorithm $algorithm = null;

    #[ORM\Column(length: 255)]
    private ?string $result = null;

    #[ORM\Column(length: 255)]
    private ?string $input = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAlgorithm(): ?Algorithm
    {
        return $this->algorithm;
    }

    public function setAlgorithm(Algorithm $algorithm): static
    {
        $this->algorithm = $algorithm;

        return $this;
    }

    public function getResult(): ?string
    {
        return $this->result;
    }

    public function setResult(string $result): static
    {
        $this->result = $result;

        return $this;
    }

    public function getInput(): ?string
    {
        return $this->input;
    }

    public function setInput(string $input): static
    {
        $this->input = $input;

        return $this;
    }
}
