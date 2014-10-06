<?php
/**
 * @file
 * Slide model.
 */

namespace Indholdskanalen\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Extra
 *
 * @ORM\Table(name="slide")
 * @ORM\Entity
 */
class Slide {
  /**
   * @ORM\Column(type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $id;

  /**
   * @ORM\Column(name="title", type="text", nullable=false)
   */
  private $title;

  /**
   * @ORM\Column(name="orientation", type="string", nullable=true)
   */
  private $orientation;

  /**
   * @ORM\Column(name="template", type="string", nullable=true)
   */
  private $template;

  /**
   * @ORM\Column(name="created_at", type="integer", nullable=false)
   */
  private $created_at;

  /**
   * @ORM\Column(name="options", type="json_array", nullable=true)
   */
  private $options;

  /**
   * @ORM\Column(name="user", type="text", nullable=true)
   */
  private $user;

  /**
   * @ORM\Column(name="duration", type="integer", nullable=true)
   */
  private $duration;

  /**
   * @ORM\Column(name="schedule_from", type="integer", nullable=true)
   */
  private $schedule_from;

  /**
   * @ORM\Column(name="schedule_to", type="integer", nullable=true)
   */
  private $schedule_to;

  /**
   * @ORM\Column(name="published", type="boolean", nullable=true)
   */
  private $published;

  /**
   * @ORM\OneToMany(targetEntity="ChannelSlideOrder", mappedBy="slide")
   * @ORM\OrderBy({"sortOrder" = "ASC"})
   **/
  private $channelSlideOrders;

  /**
   * @ORM\OneToMany(targetEntity="MediaOrder", mappedBy="slide")
   * @ORM\OrderBy({"sortOrder" = "ASC"})
   **/
  private $mediaOrders;

  /**
   * @ORM\Column(name="media_type", type="string", nullable=true)
   *   "video" or "image".
   */
  private $mediaType;

  /**
   * Constructor
   */
  public function __construct()
  {
    $this->channelSlideOrders = new \Doctrine\Common\Collections\ArrayCollection();
    $this->mediaOrders = new \Doctrine\Common\Collections\ArrayCollection();
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
   * Set template
   *
   * @param \string $template
   */
  public function setTemplate($template) {
    $this->template = $template;
  }

  /**
   * Get template
   *
   * @return \string
   */
  public function getTemplate() {
    return $this->template;
  }

  /**
   * Set user
   *
   * @param string $user
   */
  public function setUser($user) {
    $this->user = $user;
  }

  /**
   * Get user
   *
   * @return string
   */
  public function getUser() {
    return $this->user;
  }

  /**
   * Set options
   *
   * @param string $options
   */
  public function setOptions($options) {
    $this->options = $options;
  }

  /**
   * Get options
   *
   * @return string
   */
  public function getOptions() {
    return $this->options;
  }

  /**
   * Set created_at
   *
   * @param integer $createdAt
   * @return Slide
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
   * Set duration
   *
   * @param integer $duration
   * @return Slide
   */
  public function setDuration($duration)
  {
    $this->duration = $duration;

    return $this;
  }

  /**
   * Get duration
   *
   * @return integer
   */
  public function getDuration()
  {
    return $this->duration;
  }

  /**
   * Add channelSlideOrder
   *
   * @param \Indholdskanalen\MainBundle\Entity\ChannelSlideOrder $channelSlideOrder
   * @return Slide
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
   * Set published
   *
   * @param boolean $published
   * @return Slide
   */
  public function setPublished($published)
  {
    $this->published = $published;

    return $this;
  }

  /**
   * Get published
   *
   * @return boolean
   */
  public function getPublished()
  {
    return $this->published;
  }

  /**
   * Set schedule_from
   *
   * @param integer $scheduleFrom
   * @return Slide
   */
  public function setScheduleFrom($scheduleFrom)
  {
    $this->schedule_from = $scheduleFrom;

    return $this;
  }

  /**
   * Get schedule_from
   *
   * @return integer
   */
  public function getScheduleFrom()
  {
    return $this->schedule_from;
  }

  /**
   * Set schedule_to
   *
   * @param integer $scheduleTo
   * @return Slide
   */
  public function setScheduleTo($scheduleTo)
  {
    $this->schedule_to = $scheduleTo;

    return $this;
  }

  /**
   * Get schedule_to
   *
   * @return integer
   */
  public function getScheduleTo()
  {
    return $this->schedule_to;
  }

  /**
   * Add mediaOrder
   *
   * @param \Indholdskanalen\MainBundle\Entity\MediaOrder $mediaOrder
   * @return Slide
   */
  public function addMediaOrder(\Indholdskanalen\MainBundle\Entity\MediaOrder $mediaOrder)
  {
    $this->mediaOrders[] = $mediaOrders;

    return $this;
  }

  /**
   * Remove mediaOrder
   *
   * @param \Indholdskanalen\MainBundle\Entity\MediaOrder $mediaOrder
   */
  public function removeMediaOrder(\Indholdskanalen\MainBundle\Entity\MediaOrder $mediaOrder)
  {
    $this->mediaOrders->removeElement($mediaOrder);
  }

  /**
   * Get mediaOrders
   *
   * @return \Doctrine\Common\Collections\Collection
   */
  public function getMediaOrders()
  {
    return $this->mediaOrders;
  }

  /**
   * Set mediaType
   *
   * @param string $mediaType
   * @return Slide
   */
  public function setMediaType($mediaType)
  {
    $this->mediaType = $mediaType;

    return $this;
  }

  /**
   * Get mediaType
   *
   * @return string
   */
  public function getMediaType()
  {
    return $this->mediaType;
  }
}
