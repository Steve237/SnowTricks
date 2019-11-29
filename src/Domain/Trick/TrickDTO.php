<?php

namespace App\Domain\Trick;

use App\Entity\Picture;
use App\Entity\Trick;
use Symfony\Component\Validator\Constraints as Assert;

final class TrickDTO
{

	/**
	 * @var integer
	 */
	protected $id;

    /**
     * @var string
     * @Assert\NotBlank(
     *     message="Le nom du trick ne doit pas être vide !"
     * )
     */
    protected $name;

    /**
     * @var string
     * @Assert\NotBlank(
     *     message="La description du trick ne doit pas être vide !"
     * )
     * @Assert\Length(
     *     min=10,
     *     minMessage="Votre description doit comporter plus de 10 caractères !"
     * )
     */
    protected $description;

	/**
	 * @Assert\NotBlank(
	 *     message="Vous devez choisir un style !"
	 * )
	 */
    protected $style;

    /**
     * @Assert\Valid()
	 * @Assert\NotBlank(
	 *     message="Le trick doit contenir au moins une image !"
	 * )
     */
    protected $pictures;

    /**
     * @Assert\Valid()
     */
    protected $videos;

	/**
	 * Change Trick to TrickDTO
	 * @param Trick $trick
	 * @return TrickDTO
	 */
	public static function updateToDto(Trick $trick)
	{
		$trickDto = new self();
		$trickDto
			->setId($trick->getId())
			->setName($trick->getName())
			->setDescription($trick->getDescription())
			->setStyle($trick->getStyle());

		$pictures = self::getPicturesDto($trick);

		foreach ($pictures as $picture) {
			$trickDto->addPicture($picture);
		}

		$videos = self::getVideosDto($trick);

		foreach($videos as $video) {
			$trickDto->addVideo($video);
		}

		return $trickDto;
	}

	/**
	 * Get PictureDTO from Trick
	 * @param Trick $trick
	 * @return array
	 */
	public static function getPicturesDto(Trick $trick)
	{
		$pictures = [];

		foreach ($trick->getPictures() as $picture) {
			$pictureDto = new PictureDTO();
			$pictureDto
				->setId($picture->getId())
				->setLink($picture->getLink())
				->setAlt($picture->getAlt());

			$pictures[] = $pictureDto;
		}

		return $pictures;
	}

	/**
	 * Get VideoDTO from Trick
	 * @param Trick $trick
	 * @return array
	 */
	public static function getVideosDto(Trick $trick)
	{
		$videos = [];

		foreach ($trick->getVideos() as $video) {
			$videoDto = new VideoDTO();
			$videoDto
				->setId($video->getId())
				->setLink($video->getLink());

			$videos[] = $videoDto;
		}

		return $videos;
	}

	/**
	 * @return mixed
	 */
	public function getId()
	{
		return $this->id;
	}

	public function setId(int $id): self
	{
		$this->id = $id;

		return $this;
	}

	/**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

	public function setName(string $name): self
	{
		$this->name = $name;

		return $this;
	}

    /**
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

	public function setDescription(string $description): self
	{
		$this->description = $description;

		return $this;
	}

    /**
     * @return mixed
     */
    public function getStyle()
    {
        return $this->style;
    }

    /**
     * @param mixed $style
     */
    public function setStyle($style): void
    {
        $this->style = $style;
    }

	public function addPicture(PictureDTO $picture): self
	{
		$this->pictures[] = $picture;

		return $this;
	}

    /**
     * @return mixed
     */
    public function getPictures()
    {
        return $this->pictures;
    }

    /**
     * @param mixed $pictures
     */
    public function setPictures($pictures): void
    {
        $this->pictures = $pictures;
    }

	public function addVideo(VideoDTO $video): self
	{
		$this->videos[] = $video;

		return $this;
	}

    /**
     * @return mixed
     */
    public function getVideos()
    {
        return $this->videos;
    }

    /**
     * @param mixed $videos
     */
    public function setVideos($videos): void
    {
        $this->videos = $videos;
    }
}