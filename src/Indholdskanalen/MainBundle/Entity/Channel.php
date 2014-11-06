<?php
/**
 * @file
 * Channel model.
 */

namespace Indholdskanalen\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\VirtualProperty;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\AccessorOrder;
use JMS\Serializer\Annotation\MaxDepth;


/**
 * Extra
 *
 * @AccessorOrder("custom", custom = {"id", "title" ,"orientation", "created_at", "slides"})
 *
 * @ORM\Table(name="channel")
 * @ORM\Entity
 */
class Channel {
  /**
   * @ORM\Column(type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   * @Groups({"api", "api-bulk", "search", "sharing"})
   */
  private $id;

  /**
   * @ORM\Column(name="title", type="text", nullable=false)
   * @Groups({"api", "api-bulk", "search", "sharing"})
   */
  private $title;

  /**
   * @ORM\Column(name="orientation", type="string", nullable=true)
   * @Groups({"api", "api-bulk", "search", "sharing"})
   */
  private $orientation;

  /**
   * @ORM\Column(name="created_at", type="integer", nullable=false)
   * @Groups({"api", "api-bulk", "search", "sharing"})
   */
  private $created_at;

  /**
   * @ORM\OneToMany(targetEntity="ChannelSlideOrder", mappedBy="channel", orphanRemoval=true)
   * @ORM\OrderBy({"sortOrder" = "ASC"})
   **/
  private $channelSlideOrders;

  /**
   * @ORM\ManyToMany(targetEntity="Screen", inversedBy="channels")
   * @ORM\JoinTable(name="screens_channels")
   * @Groups({"api"})
   */
  private $screens;

	/**
	 * @ORM\Column(name="user", type="integer", nullable=true)
	 * @Groups({"api", "search"})
	 */
	private $user;

  /**
   * Constructor
   */
  public function __construct()
  {
    $this->screens = new ArrayCollection();
    $this->channelSlideOrders = new ArrayCollection();
  }

  /**
   * Get id
   *
   * @return integer
   */
  public function getId() {
    return $this->id;
  }

  /**
   * Set title
   *
   * @param string $title
   */
  public function setTitle($title) {
    $this->title = $title;
  }

  /**
   * Get title
   *
   * @return string
   */
  public function getTitle() {
    return $this->title;
  }

  /**
   * Set orientation
   *
   * @param \int $orientation
   */
  public function setOrientation($orientation) {
    $this->orientation = $orientation;
  }

  /**
   * Get orientation
   *
   * @return \string
   */
  public function getOrientation() {
    return $this->orientation;
  }

  /**
   * Set created_at
   *
   * @param integer $createdAt
   * @return Channel
   */
  public function setCreatedAt($createdAt)
  {
    $this->created_at = $createdAt;

    return $this;
  }

  /**
   * Get created_at
   *
   * @return integer
   */
  public function getCreatedAt()
  {
    return $this->created_at;
  }

  /**
   * Add screen
   *
   * @param \Indholdskanalen\MainBundle\Entity\Screen $screen
   * @return Channel
   */
  public function addScreen(\Indholdskanalen\MainBundle\Entity\Screen $screen) {
    $this->screens[] = $screen;

    return $this;
  }

  /**
   * Remove screen
   *
   * @param \Indholdskanalen\MainBundle\Entity\Screen $screen
   */
  public function removeScreen(\Indholdskanalen\MainBundle\Entity\Screen $screen) {
    $this->screens->removeElement($screen);
  }

  /**
   * Get screens
   *
   * @return \Doctrine\Common\Collections\Collection
   */
  public function getScreens() {
    return $this->screens;
  }


  /**
   * Add channelSlideOrder
   *
   * @param \Indholdskanalen\MainBundle\Entity\ChannelSlideOrder $channelSlideOrder
   * @return Channel
   */
  public function addChannelSlideOrder(\Indholdskanalen\MainBundle\Entity\ChannelSlideOrder $channelSlideOrder)
  {
    $this->channelSlideOrders[] = $channelSlideOrder;

    return $this;
  }

  /**
   * Remove channelSlideOrder
   *
   * @param \Indholdskanalen\MainBundle\Entity\ChannelSlideOrder $channelSlideOrder
   */
  public function removeChannelSlideOrder(\Indholdskanalen\MainBundle\Entity\ChannelSlideOrder $channelSlideOrder)
  {
    $this->channelSlideOrders->removeElement($channelSlideOrder);
  }

  /**
   * Get channelSlideOrder
   *
   * @return \Doctrine\Common\Collections\Collection
   */
  public function getChannelSlideOrders()
  {
	  return $this->channelSlideOrders;
  }


	/**
   * Get all slides
   *
   * @return \Doctrine\Common\Collections\Collection
   *
   * @VirtualProperty
   * @SerializedName("slides")
   * @Groups({"api"})
   */
  public function getAllSlides()
  {
    $result = new ArrayCollection();
	  $slideorders = $this->getChannelSlideOrders();
    foreach($slideorders as $slideorder) {
      $result->add($slideorder->getSlide());
    }
    return $result;
  }

	/**
	 * Get all published slides
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 *
	 * @VirtualProperty
	 * @SerializedName("slides")
	 * @Groups({"api-bulk"})
	 */
	public function getPublishedSlides()
	{
		$result = new ArrayCollection();
		$criteria = Criteria::create()->orderBy(array("sortOrder" => Criteria::ASC));

		$slideorders = $this->getChannelSlideOrders()->matching($criteria);
		foreach($slideorders as $slideorder) {
			$slide = $slideorder->getSlide();
			if($slide->isSlideActive()) {
				$result->add($slide);
			}
		}

		return $result;
	}


    /**
     * Set user
     *
     * @param integer $user
     * @return Channel
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return integer 
     */
    public function getUser()
    {
        return $this->user;
    }
}
