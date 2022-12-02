<?php

namespace Elementor;

use Elementor\Core\Kits\Documents\Tabs\Global_Colors;

if (!defined('ABSPATH')) {
    exit;
}

class Button_Hover_Effect_Elementor_Addons extends Widget_Base
{

    public function get_name()
    {
        return 'button_hover_effect_elementor';
    }

    public function get_title()
    {
        return 'Button Hover Effect - Elementor Add-on';
    }

    public function get_icon()
    {
        return 'eicon-button';
    }

    public function get_categories()
    {
        return ['general'];
    }


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
                'label' => 'Title',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Default Title',
                'placeholder' => esc_html__('Type your title here', 'textdomain'),
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label' => 'Link',
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://yourdomain.com', 'textdomain'),
            ]
        );


        $this->add_control(
            'alignment',
            [
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'label' => esc_html__( 'Alignment', 'textdomain' ),
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'textdomain' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'textdomain' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'textdomain' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .button_wrapper ' => 'text-align: {{VALUE}};',
                ],
                'default' => 'center',


            ]
        );



        $this->add_control(
            'background_color',
            [
                'label' => esc_html__('Background Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .button_wrapper' => 'background-color: {{VALUE}};',
                ],
                'global' => [
                    'default' => Global_Colors::COLOR_PRIMARY,
                ],
            ]
        );


        $this->add_control(
            'background_color',
            [
                'label' => esc_html__('Border Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .button_wrapper' => 'border-color: {{VALUE}};',
                ],
                'global' => [
                    'default' => Global_Colors::COLOR_PRIMARY,
                ],
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => esc_html__('Text Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .button_wrapper ' => 'color: {{VALUE}};',
                ],
                'global' => [
                    'default' => Global_Colors::COLOR_TEXT,
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Css_Filter::get_type(),
            [
                'name' => 'custom_css_filters',
                'selector' => '{{WRAPPER}} .button_wrapper',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Text_Stroke::get_type(),
            [
                'name' => 'text_stroke',
                'selector' => '{{WRAPPER}} .button_wrapper',
            ]
        );


        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'selector' => '{{WRAPPER}} .button_wrapper',
            ]
        );


        $this->add_control(
            'hover_effect',
            [
                'label' => esc_html__('Effect', 'button-hover-effects-elementor'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'hover-grow' => esc_html__('Grow', 'button-hover-effects-elementor'),
                    'hover-shrink' => esc_html__('Shrink', 'button-hover-effects-elementor'),
                    'hover-pulse' => esc_html__('Pulse', 'button-hover-effects-elementor'),
                    'hover-pulse-shrink' => esc_html__('Pulse Shrink', 'button-hover-effects-elementor'),
                    'hover-pulse-grow' => esc_html__('Pulse Grow', 'button-hover-effects-elementor'),
                    'hover-push' => esc_html__('Push', 'button-hover-effects-elementor'),
                    'hover-pop' => esc_html__('Pop', 'button-hover-effects-elementor'),
                    'hover-sink' => esc_html__('Sink', 'button-hover-effects-elementor'),
                    'hover-float' => esc_html__('Float', 'button-hover-effects-elementor'),
                    'hover-rotate' => esc_html__('Rotate', 'button-hover-effects-elementor'),
                    'hover-grow-rotate' => esc_html__('Grow Rotate', 'button-hover-effects-elementor'),
                    'hover-bounce-in' => esc_html__('Bounce In', 'button-hover-effects-elementor'),
                    'hover-bob' => esc_html__('Bob', 'button-hover-effects-elementor'),
                    'hover-hang' => esc_html__('Hang', 'button-hover-effects-elementor'),
                    'hover-skew' => esc_html__('Skew', 'button-hover-effects-elementor'),
                    'hover-skew-forward' => esc_html__('Skew Forward', 'button-hover-effects-elementor'),
                    'hover-skew-backward' => esc_html__('Skew Backward', 'button-hover-effects-elementor'),
                    'hover-wobble-vertical' => esc_html__('Wobble Vertical', 'button-hover-effects-elementor'),
                    'hover-wobble-horizontal' => esc_html__('Wobble Horizontal', 'button-hover-effects-elementor'),
                    'hover-wobble-to-bottom-right' => esc_html__('Wobble To Bottom', 'button-hover-effects-elementor'),
                    'hover-wobble-to-top-right' => esc_html__('Wobble To Top Right', 'button-hover-effects-elementor'),
                    'hover-wobble-top' => esc_html__('Wobble Top', 'button-hover-effects-elementor'),
                    'hover-wobble-bottom' => esc_html__('Wobble Bottom', 'button-hover-effects-elementor'),
                    'hover-wobble-skew' => esc_html__('Wobble Skew', 'button-hover-effects-elementor'),
                    'hover-buzz' => esc_html__('Buzz', 'button-hover-effects-elementor'),
                    'hover-buzz-out' => esc_html__('Buzz Out', 'button-hover-effects-elementor'),
                    'hover-forward' => esc_html__('Hover Forward', 'button-hover-effects-elementor'),
                    'hover-backward' => esc_html__('Hover Backward', 'button-hover-effects-elementor'),
                    'hover-fade' => esc_html__('Hover Fade', 'button-hover-effects-elementor'),
                    'hover-back-pulse' => esc_html__('Back Pulse', 'button-hover-effects-elementor'),
                    'hover-sweep-to-right' => esc_html__('Sweep to Right', 'button-hover-effects-elementor'),
                ],
                'default' => 'hover-grow',
            ]
        );


        $this->end_controls_section();
    }

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
        $settings = $this->get_settings_for_display();

        ?>

        <a href="<?= $settings['button_link']['url'] ? esc_url($settings['button_link']['url']) : esc_url('javascript:void(0)') ?>"
           class="<?= esc_html($settings['hover_effect']) ?> button_wrapper"><?= esc_html($settings['button_text']) ?></a>

        <?php
    }
}

Plugin::instance()->widgets_manager->register_widget_type(new Button_Hover_Effect_Elementor_Addons());