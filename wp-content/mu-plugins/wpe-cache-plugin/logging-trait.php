<?php

declare(strict_types=1);
namespace wpengine\cache_plugin;

// phpcs:disable WordPress.PHP.DevelopmentFunctions

abstract class CachePluginLoggingTags {
	const WPE_CACHE_PLUGIN_INFO_LOG_TAG  = 'wpe_cache_plugin:info:';
	const WPE_CACHE_PLUGIN_ERROR_LOG_TAG = 'wpe_cache_plugin:error:';
}

trait CachePluginLoggingTrait {
	protected function log_info( $message ) {
		error_log( CachePluginLoggingTags::WPE_CACHE_PLUGIN_INFO_LOG_TAG . ' ' . $message );
	}

	protected function log_error( $message ) {
		error_log( CachePluginLoggingTags::WPE_CACHE_PLUGIN_ERROR_LOG_TAG . ' ' . $message );
	}
}
