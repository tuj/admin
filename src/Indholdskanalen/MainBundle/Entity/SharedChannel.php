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
 * @ORM\Table(name="ik_shared_channel")
 * @ORM\Entity
 */
class SharedChannel {
  /**
   * @ORM\Column(type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   * @Groups({"api", "api-bulk", "search", "sharing"})
   */
  private $id;

  /**
   * @ORM\Column(name="unique_id", type="text", nullable=false)
   * @Groups({"api", "api-bulk", "search", "sharing"})
   */
  private $uniqueId;

  /**
   * @ORM\Column(name="`index`", type="text", nullable=false)
   * @Groups({"api", "api-bulk", "search", "sharing"})
   */
  private $index;

  /**
   * @ORM\Column(name="created_at", type="integer", nullable=false)
   * @Groups({"api", "api-bulk", "search", "sharing"})
   */
  private $created_at;

  /**
   * @ORM\ManyToMany(targetEntity="Screen", inversedBy="shared_channels")
   * @ORM\JoinTable(name="ik_screens_shared_channels")
   * @Groups({"api"})
   */
  private $screens;

  /**
   * @ORM\Column(name="modified_at", type="integer", nullable=false)
   */
  private $modified_at;

  /**
   * @ORM\Column(name="content", type="text", nullable=true)
   * @Groups({"api"})
   */
  private $content;

  /**
   * @ORM\Column(name="last_push_hash", type="string", nullable=true)
   */
  private $lastPushHash;

  /**
   * @ORM\Column(name="last_push_screens", type="json_array", nullable=true)
   */
  private $lastPushScreens;

  /**
   * Constructor
   */
  public function __construct() {
    $this->screens = new ArrayCollection();
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
   * Set lastPushHash
   *
   * @param string $lastPushHash
   * @return Screen
   */
  public function setLastPushHash($lastPushHash) {
    $this->lastPushHash = $lastPushHash;

    return $this;
  }

  /**
   * Get lastPushHash
   *
   * @return string
   */
  public function getLastPushHash() {
    return $this->lastPushHash;
  }


  /**
   * Set lastPushScreens
   *
   * @param string $lastPushScreens
   * @return Screen
   */
  public function setLastPushScreens($lastPushScreens) {
    $this->lastPushScreens = $lastPushScreens;

    return $this;
  }

  /**
   * Get lastPushScreens
   *
   * @return string
   */
  public function getLastPushScreens() {
    return $this->lastPushScreens;
  }

  /**
   * Set uniqueId
   *
   * @param string $uniqueId
   */
  public function setUniqueId($uniqueId) {
    $this->uniqueId = $uniqueId;
  }

  /**
   * Get uniqueId
   *
   * @return string
   */
  public function getUniqueId() {
    return $this->uniqueId;
  }


  /**
   * Set index
   *
   * @param string $index
   */
  public function setIndex($index) {
    $this->index = $index;
  }

  /**
   * Get index
   *
   * @return string
   */
  public function getIndex() {
    return $this->index;
  }

  /**
   * Set created_at
   *
   * @param integer $createdAt
   * @return Channel
   */
  public function setCreatedAt($createdAt) {
    $this->created_at = $createdAt;

    return $this;
  }

  /**
   * Get created_at
   *
   * @return integer
   */
  public function getCreatedAt() {
    return $this->created_at;
  }

  /**
   * Add screen
   *
   * @param \Indholdskanalen\MainBundle\Entity\Screen $screen
   * @return Channel
   */
  public function addScreen(Screen $screen) {
    $this->screens[] = $screen;

    return $this;
  }

  /**
   * Remove screen
   *
   * @param \Indholdskanalen\MainBundle\Entity\Screen $screen
   */
  public function removeScreen(Screen $screen) {
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
   * Set modified_at
   *
   * @param integer $modifiedAt
   * @return Channel
   */
  public function setModifiedAt($modifiedAt) {
    $this->modified_at = $modifiedAt;

    return $this;
  }

  /**
   * Get modified_at
   *
   * @return integer
   */
  public function getModifiedAt() {
    return $this->modified_at;
  }

  /**
   * Set content
   *
   * @param string $content
   * @return Channel
   */
  public function setContent($content) {
    $this->content = $content;

    return $this;
  }

  /**
   * Get content
   *
   * @return integer
   */
  public function getContent() {
    return $this->content;
  }

  /**
   * Get screens
   *
   * @return \array
   *
   * @VirtualProperty
   * @SerializedName("screens")
   * @Groups({"middleware"})
   */
  public function getMiddlewareScreens() {
    $slides = array();
    foreach($this->getScreens() as $screen) {
      $slides[] = $screen->getId();
    }
    return $slides;
  }

  /**
   * Get channel content.
   *
   * @return \array
   *
   * @VirtualProperty
   * @SerializedName("data")
   * @Groups({"middleware"})
   */
  public function getData() {
    return array(
      'id' => $this->getUniqueId(),
      'slides' => json_encode(json_decode($this->content)->slides)
    );
  }
}
