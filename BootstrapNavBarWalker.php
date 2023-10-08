<?php

class BootstrapNavBarWalker extends Walker_Nav_Menu {

	private $maxSousNiveauSupporte = 1;

	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		if($depth > $this->maxSousNiveauSupporte-1) return;
		$output .= '<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink-'.$args->dropDownId.'">';
	}

	public function end_lvl( &$output, $depth = 0, $args = array() ) {
		if($depth > $this->maxSousNiveauSupporte-1) return;
		$output .= '</div>';
	}

	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		if($depth > $this->maxSousNiveauSupporte) return;

		// Recherce un fichier contenant le sous-menu
		// $fichierSousMenu = __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'menu'.DIRECTORY_SEPARATOR.substr($item->url,1).'.php';
		// $sousMenuOutput = '';
		// if (file_exists($fichierSousMenu)) {
		//     $sousMenuOutput = '<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink-'.$args->dropDownId.'">';
		//     $sousMenuOutput .= require($fichierSousMenu);
		//     $sousMenuOutput .= '</div>';
		//     $args->has_children = true;
		// }

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		$args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );

		$classes[] = 'nav-item';
		if ($args->has_children) $classes[] = 'dropdown';
		if (in_array('current-menu-item', $classes)) $classes[] = 'active';

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';


		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';


		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target )     ? $item->target     : ((strpos($item->url, 'http') == 0) ? '' : '_blank');
		$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
		$atts['href']   = ! empty( $item->url )        ? $item->url        : '';

		// Niveau 0 = <li>
		// Ensuite juste des liens
		$atts['class'] = 'dropdown-item';
		if($depth == 0){
			$output .= '<li' . $id . $class_names .'>';
			$atts['class'] = 'nav-link';
			if ($args->has_children) {
				$args->dropDownId = $item->ID;
				if(isset($args->dropdownToggleCSS))
					$atts['class'] .= ' '.$args->dropdownToggleCSS;
				else
					$atts['class'] .= ' dropdown-toggle';
				$atts['id'] = 'navbarDropdownMenuLink-'.$args->dropDownId;
				$atts['data-toggle'] = 'dropdown';
				$atts['aria-haspopup'] = 'true';
				$atts['aria-expanded'] = 'false';
			}
		}

		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = (('href' === $attr) ? esc_url($value) : esc_attr($value));
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		$title = apply_filters( 'the_title', $item->title, $item->ID );
		$title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

		if (substr($title,0,3) == 'fa-')
			$title = '<i class="fa '.$title.'" aria-hidden="true"></i>';

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . $title . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		// if ($title == 'RECH-PRODUCT')
		//     $item_output = '<form id="formRecherche" class="form-inline" action="/"><div class="input-group"><span class="input-group-addon" style="cursor: pointer" id="search-addon" onclick="$(\'#formRecherche\').submit()"><i class="fa fa-search" aria-hidden="true"></i></span><input type="text" class="form-control" placeholder="Recherche" aria-describedby="search-addon" name="s"></div><input type="hidden" name="post_type" value="product"></form>';

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

		if ($sousMenuOutput) $output .= $sousMenuOutput;
	}

	public function end_el( &$output, $item, $depth = 0, $args = array() ) {
		if($depth > $this->maxSousNiveauSupporte) return;
		if($depth == 0) {
			$output .= '</li>';
		}
	}

	public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
		if ( ! $element )
			return;

		if ( is_object( $args[0] ) )
		   $args[0]->has_children = ! empty( $children_elements[ $element->{$this->db_fields['id']} ] );

		parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}
}
