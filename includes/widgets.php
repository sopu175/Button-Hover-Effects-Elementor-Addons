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
                'label' => esc_html__('Effect', $this->plugin),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'hover-grow' => esc_html__('Grow', $this->plugin),
                    'hover-shrink' => esc_html__('Shrink', $this->plugin),
                    'hover-pulse' => esc_html__('Pulse', $this->plugin),
                    'hover-pulse-shrink' => esc_html__('Pulse Shrink', $this->plugin),
                    'hover-pulse-grow' => esc_html__('Pulse Grow', $this->plugin),
                    'hover-push' => esc_html__('Push', $this->plugin),
                    'hover-pop' => esc_html__('Pop', $this->plugin),
                    'hover-sink' => esc_html__('Sink', $this->plugin),
                    'hover-float' => esc_html__('Float', $this->plugin),
                    'hover-rotate' => esc_html__('Rotate', $this->plugin),
                    'hover-grow-rotate' => esc_html__('Grow Rotate', $this->plugin),
                    'hover-bounce-in' => esc_html__('Bounce In', $this->plugin),
                    'hover-bounce-out' => esc_html__('Bounce OUt', $this->plugin),

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