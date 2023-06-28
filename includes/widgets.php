<?php

namespace Elementor;

use Elementor\Core\Kits\Documents\Tabs\Global_Colors;

if (!defined('ABSPATH')) {
    exit;
}

class Button_Hover_Effect_Elementor_Addons extends Widget_Base
{
	/**
	 * Returns the name of the plugin.
	 *
	 * @return string The plugin name.
	 */
	public function get_name()
	{
		return 'button_hover_effect_elementor';
	}

	/**
	 * Returns the title of the plugin.
	 *
	 * @return string The plugin title.
	 */
	public function get_title()
	{
		return 'Button Hover Effect - Elementor Add-on';
	}

	/**
	 * Returns the icon for the plugin.
	 *
	 * @return string The plugin icon.
	 */
	public function get_icon()
	{
		return 'eicon-button';
	}

	/**
	 * Returns the categories for the plugin.
	 *
	 * @return array The plugin categories.
	 */
	public function get_categories()
	{
		return ['general'];
	}


	/**
	 * Register the controls for the plugin.
	 */
	protected function register_controls()
	{
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__('Content', 'textdomain'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				'selectors' => [
					'{{WRAPPER}} .button_wrapper',
				],
			]
		);

		$this->add_control(
			'button_text',
			[
				'label' => esc_html__('Title', 'textdomain'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'Default Title',
				'placeholder' => esc_html__('Type your title here', 'textdomain'),
			]
		);

		$this->add_control(
			'button_link',
			[
				'label' => esc_html__('Link', 'textdomain'),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__('https://yourdomain.com', 'textdomain'),
			]
		);

		// ... Rest of the controls ...

		$this->end_controls_section();
	}


	/**
	 * Render the plugin output.
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();

		$this->add_inline_editing_attributes('label_heading', 'basic');
		$this->add_render_attribute(
			'label_heading',
			[
				'class' => ['advertisement__label-heading'],
			]
		);

		?>

        <a href="<?= $settings['button_link']['url'] ? esc_url($settings['button_link']['url']) : esc_url('javascript:void(0)') ?>"
           class="<?= esc_attr($settings['hover_effect']) ?> button_wrapper"><?= esc_html($settings['button_text']) ?></a>

		<?php
	}

}

Plugin::instance()->widgets_manager->register_widget_type(new Button_Hover_Effect_Elementor_Addons());