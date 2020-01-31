<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Job Package Product Type
 */
class WC_Product_Property_Package_Subscription extends Realteo_Paid_Properties_Subscription_Product {

	/**
	 * Constructor
	 *
	 * @param int|WC_Product|object $product Product ID, post object, or product object
	 */
	public function __construct( $product ) {
		parent::__construct( $product );
		$this->product_type = 'property_package_subscription';
	}

	/**
	 * Get internal type.
	 *
	 * @return string
	 */
	public function get_type() {
		return 'property_package_subscription';
	}

	/**
	 * Checks the product type.
	 *
	 * Backwards compat with downloadable/virtual.
	 *
	 * @access public
	 * @param mixed $type Array or string of types
	 * @return bool
	 */
	public function is_type( $type ) {
		return ( 'property_package_subscription' == $type || ( is_array( $type ) && in_array( 'property_package_subscription', $type ) ) ) ? true : parent::is_type( $type );
	}

	/**
	 * We want to sell jobs one at a time
	 *
	 * @return boolean
	 */
	public function is_sold_individually() {
		return true;
	}

	/**
	 * Get the add to url used mainly in loops.
	 *
	 * @access public
	 * @return string
	 */
	public function add_to_cart_url() {
		$url = $this->is_in_stock() ? remove_query_arg( 'added-to-cart', add_query_arg( 'add-to-cart', $this->id ) ) : get_permalink( $this->id );

		return apply_filters( 'woocommerce_product_add_to_cart_url', $url, $this );
	}

	/**
	 * Jobs are always virtual
	 *
	 * @return boolean
	 */
	public function is_virtual() {
		return true;
	}

	/**
	 * Return job listing duration granted
	 *
	 * @return int
	 */
	public function get_duration() {
		$property_duration = $this->get_property_duration();
		if ( 'listing' === $this->get_package_subscription_type() ) {
			return false;
		} elseif ( $property_duration ) {
			return $property_duration;
		} else {
			return get_option( 'realteo_submission_duration' );
		}
	}

	/**
	 * Return job listing limit
	 *
	 * @return int 0 if unlimited
	 */
	public function get_limit() {
		$property_limit = $this->get_property_limit();
		if ( $property_limit ) {
			return $property_limit;
		} else {
			return 0;
		}
	}

	/**
	 * Return if featured
	 *
	 * @return bool true if featured
	 */
	public function is_property_featured() {
		return 'yes' === $this->is_property_featured();
	}

	/**
	 * Get job listing featured flag
	 *
	 * @return string
	 */
	public function get_property_featured() {
		return $this->get_product_meta( 'property_featured' );
	}

	/**
	 * Get job listing limit
	 *
	 * @return int
	 */
	public function get_property_limit() {
		return $this->get_product_meta( 'property_limit' );
	}

	/**
	 * Get job listing duration
	 *
	 * @return int
	 */
	public function get_property_duration() {
		return $this->get_product_meta( 'property_duration' );
	}

	/**
	 * Get package subscription type
	 *
	 * @return string
	 */
	public function get_package_subscription_type() {
		return $this->get_product_meta( 'package_subscription_type' );
	}
}
