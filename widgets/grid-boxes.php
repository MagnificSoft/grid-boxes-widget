<?php

// Make sure this file is called from within WordPress.
if (!defined('ABSPATH')) {
    exit;
}

// General settings
class Grid_Boxes_Widget extends \Elementor\Widget_Base
{   	
    public function get_script_depends() {
        return [ 'grid_box_script' ];
    }

    public function get_style_depends() {
		return [ 'grid_box_style'];
	}

    public function get_name()
    {
        return 'grid-boxes';
    }

    public function get_title()
    {
        return __('Grid Boxes', 'grid-boxes-widget');
    }

    public function get_icon()
    {
        return 'eicon-gallery-grid';
    }

    public function get_categories()
    {
        return ['general'];
    }

    // Registration of controllers
    protected function _register_controls()
    {
        $this->start_controls_section(
            'section_content',
            [
                'label' => __('Grid Boxes', 'grid-boxes-widget'),
            ]
        );

        $this->add_control(
			'show_arrows',
			[
				'label' => esc_html__( 'Show Arrows', 'grid-boxes-widget' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'grid-boxes-widget' ),
				'label_off' => esc_html__( 'Hide', 'grid-boxes-widget' ),
				'return_value' => 'yes',
				'default' => 'yes',
                'frontend_available' => true,
			]
		);

        $repeater = new \Elementor\Repeater();
        $repeater->start_controls_tabs(
			'box-settings'
		);
       
        $repeater->start_controls_tab(
			'box-settings-content',
			[
				'label' => esc_html__( 'Content', 'grid-boxes-widget' ),
			]
		);

        $repeater->add_control(
            'box_text',
            [
                'label' => __('Text', 'grid-boxes-widget'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Box Text', 'grid-boxes-widget'),
            ]
        );
        
        $repeater->add_control(
			'box_description',
			[
				'label' => esc_html__( 'Description', 'grid-boxes-widget' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 5,
			]
		);

        $repeater->add_control(
            'box_image',
            [
                'label' => __('Image', 'grid-boxes-widget'),
                'type' => \Elementor\Controls_Manager::MEDIA,
            ]
        );

		$repeater->add_control(
			'box_icon',
			[
				'label' => esc_html__( 'Icon', 'grid-boxes-widget' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fab fa-facebook-f',
					'library' => 'fa-brands',
				],
			]
		);
        
        $repeater->add_control(
            'box_video',
            [
                'label' => __('Video', 'grid-boxes-widget'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'media_types' => ['video']
            ]
        );

        $repeater->end_controls_tab();

        $repeater->start_controls_tab(
			'box-settings-style',
			[
				'label' => esc_html__( 'Style', 'grid-boxes-widget' ),
			]
		);

        $repeater->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
                'label' => __('Background Style', 'grid-boxes-widget'),
				'name' => 'background',
				'types' => [ 'classic', 'gradient' ],
                'selector' => '{{CURRENT_ITEM}} .grid-box_content',
			]
		);

        $repeater->end_controls_tab();
        
        $this->add_control(
            'grid_boxes',
            [
                'label' => __('Grid Boxes', 'grid-boxes-widget'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'box_text' => __('Box 1', 'grid-boxes-widget'),
                    ],
                    [
                        'box_text' => __('Box 2', 'grid-boxes-widget'),
                    ],
                ],
                'title_field' => '{{{ box_text }}}',
            ]
        );

        $this->end_controls_section();

        // Style tabs
        // Style title
        $this->start_controls_section(
			'style_content_title',
			[
				'label' => esc_html__( 'Title', 'grid-boxes-widget' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
            'box_color_title',
            [
                'label' => esc_html__('Image Title Color', 'grid-boxes-widget'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
                    '{{WRAPPER}} .grid_box_title' => 'color: {{VALUE}}',
                ]
            ]
        );

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
                'label' => esc_html__('Title Typography', 'grid-boxes-widget'),
				'name' => 'image_title_typography',
				'selector' => '{{WRAPPER}} .grid_box_title',
			]
		);

        $this->add_control(
            'box_color_title_hover',
            [
                'label' => esc_html__('Hover Title Color', 'grid-boxes-widget'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
                    '{{WRAPPER}} .title-on-hover' => 'color: {{VALUE}}',
                ]
            ]
        );

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
                'label' => esc_html__('Hover Title Typography', 'grid-boxes-widget'),
				'name' => 'hover_title_typography',
				'selector' => '{{WRAPPER}} .title-on-hover',
			]
		);

        $this->end_controls_section();

        // Style description
        $this->start_controls_section(
			'style_content_description',
			[
				'label' => esc_html__( 'Description', 'grid-boxes-widget' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
            'box_color_description',
            [
                'label' => esc_html__('Description Color', 'grid-boxes-widget'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
                    '{{WRAPPER}} p' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
                'label' => esc_html__('Description Typography', 'grid-boxes-widget'),
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} p',
			]
		);

		$this->end_controls_section();

        // Style icon
        $this->start_controls_section(
			'style_content_icon',
			[
				'label' => esc_html__( 'Icon', 'grid-boxes-widget' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
            'box_color_icon',
            [
                'label' => esc_html__('Icon Color', 'grid-boxes-widget'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} i:not(.icon_hover)' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'box_color_icon_hover',
            [
                'label' => esc_html__('Hover Icon Color', 'grid-boxes-widget'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
                    '{{WRAPPER}} .icon_hover' => 'color: {{VALUE}}',
                ]
            ]
        );        

		$this->end_controls_section();        
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        if (empty($settings['grid_boxes'])) {
            return;
        }

        if ( 'yes' === $settings['show_arrows'] ) {
			echo '<img class="grid-line up_line" src="' . home_url() . '/wp-content/uploads/2024/02/hover-line1.png" alt="">';
            echo '<img class="grid-line down_line" src="' . home_url() . '/wp-content/uploads/2024/02/hover-line1.png" alt="">';
		}
        
        echo '<div class="grid-boxes">';

        foreach ($settings['grid_boxes'] as $box) {
            echo '<div class="grid-box elementor-repeater-item-' .  esc_attr($box['_id']) . '" >';
            echo '<div class="grid-box_content">';
            if (!empty($box['box_text'])) {
                echo '<div class="grid_box_title">' . esc_html($box['box_text']) . '</div>';
            }
            if (!empty($box['box_image']['url'])) {
                echo '<img src="' . esc_url($box['box_image']['url']) . '" alt="' . esc_attr($box['box_text']) . '">';
            }
            if (!empty($box['box_video'])) {
                echo '<video autoplay muted loop playsinline>';
                echo '<source src="' . esc_url($box['box_video']['url']) . '" type="video/mp4">';
                echo 'Your browser does not support the video tag.';
                echo '</video>';
            }
            if (!empty($box['box_icon']['value'])) {
                echo '<i class="' . esc_attr($box['box_icon']['value']) . '"></i>';
            }

            echo '</div>';
            echo '<div class="grid-hover-boxes">';
            if (!empty($box['box_icon']['value'])) {
                echo '<i class="' . esc_attr($box['box_icon']['value']) . ' icon_hover"></i>';
            }

            echo '<div class="grid-hover-text">';
            if (!empty($box['box_text'])) {
                echo '<div class="title-on-hover">' . esc_html($box['box_text']) . '</div>';
            }
            if (!empty($box['box_description'])) {
                echo '<p>' . esc_html($box['box_description']) . '</p>';
            }
            echo '</div>';

            echo '</div>';

            echo '</div>';
        }

        echo '</div>';
    }

    protected function _content_template()
    {
    }
}