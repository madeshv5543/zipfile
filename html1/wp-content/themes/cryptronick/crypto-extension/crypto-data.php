<?php  if ( ! defined( 'ABSPATH' ) ) { exit; }
/**
* Crypto Data
*
*
* @class 		Cryptronick_crypto_data
* @version		1.0
* @category	Class
* @author 		BlendPixelsThemes
*/
if (!class_exists('Cryptronick_crypto_data')) {
    class Cryptronick_crypto_data {
    	static $coinslist;

    	public static function load () {
    		self::$coinslist = self::get_api_data();
    	}

    	static function get_api_data($limit = '300000'){
		    $coinslist = get_transient( 'bpt-coins' );
		    if( !$coinslist ) {
		        $request = wp_remote_get( 'https://api.coinmarketcap.com/v2/ticker/?limit='.$limit );
		        if( is_wp_error( $request ) ) {
		            return false; 
		        }
		        $body = wp_remote_retrieve_body( $request );
		        $coinslist = json_decode( $body );
		        if( ! empty( $coinslist ) ) {
		         set_transient( 'bpt-coins', $coinslist, MINUTE_IN_SECONDS);
		        }
		    }

		    return $coinslist;      
		}

		static function get_coins_list() {
			$coins_list = self::$coinslist['data'];
			$coinslist_only = array();
			foreach ($coins_list as $key => $value) {
				$coinslist_only[] = $value['name'];
			}
		}
	}
	Cryptronick_crypto_data::load();
}
