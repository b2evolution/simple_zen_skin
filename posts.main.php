<?php
/**
 * This is the main/default page template.
 *
 * For a quick explanation of b2evo 2.0 skins, please start here:
 * {@link http://manual.b2evolution.net/Skins_2.0}
 *
 * The main page template is used to display the blog when no specific page template is available
 * to handle the request (based on $disp).
 *
 * @package evoskins
 * @subpackage kubrick
 *
 * @version $Id: posts.main.php,v 1.1 2007/11/29 19:29:24 fplanque Exp $
 */
if( !defined('EVO_MAIN_INIT') ) die( 'Please, do not access this page directly.' );

// This is the main template; it may be used to display very different things.
// Do inits depending on current $disp:
skin_init( $disp );


// -------------------------- HTML HEADER INCLUDED HERE --------------------------
skin_include( '_html_header.inc.php' );
// Note: You can customize the default HTML header by copying the generic
// /skins/_html_header.inc.php file into the current skin folder.
// -------------------------------- END OF HEADER --------------------------------
?>


<?php
// ------------------------- BODY HEADER INCLUDED HERE --------------------------
skin_include( '_body_header.inc.php' );
// Note: You can customize the default BODY heder by copying the generic
// /skins/_body_footer.inc.php file into the current skin folder.
// ------------------------------- END OF FOOTER --------------------------------
?>


<div id="content" class="narrowcolumn">

<?php
	// ------------------------- MESSAGES GENERATED FROM ACTIONS -------------------------
	messages( array(
			'block_start' 			=> '<div class="action_messages">',
			'block_end'   			=> '</div>',
		) );
	// --------------------------------- END OF MESSAGES ---------------------------------
?>

<?php
	// ------------------------- TITLE FOR THE CURRENT REQUEST -------------------------
	request_title( array(
			'title_before'			=> '<h2>',
			'title_after' 			=> '</h2>',
			'title_none' 			=> '',
			'glue'        			=> ' - ',
			'title_single_disp' 	=> true,
			'format'      			=> 'htmlbody',
		) );
	// ------------------------------ END OF REQUEST TITLE -----------------------------
?>

<?php
// Display message if no post:
display_if_empty();

while( $Item = & mainlist_get_item() )
{	// For each blog post, do everything below up to the closing curly brace "}"
?>
	<div class="post post<?php $Item->status_raw() ?>" lang="<?php $Item->lang() ?>">

		<?php
			$Item->locale_temp_switch(); // Temporarily switch to post locale (useful for multilingual blogs)
			$Item->anchor(); // Anchor for permalinks to refer to.
		?>

		<h2 class="evo_post_title"><?php $Item->title(); ?></h2>

		<?php
			// ---------------------- POST CONTENT INCLUDED HERE ----------------------
			skin_include( '_item_content.inc.php', array(
					'image_size'		=>	'fit-400x320',
			) );
			// Note: You can customize the default item feedback by copying the generic
			// /skins/_item_feedback.inc.php file into the current skin folder.
			// -------------------------- END OF POST CONTENT -------------------------
		?>

		<div class="postmetadata">
		<ul>

			<?php
				$Item->author( array(
					'before'			=> '<li class="author">'.T_( 'By').' ',
					'after' 			=> '</li>',
				) );
			?>

			<?php
				$Item->issue_time( array(
					'time_format' 		=> 'F jS, Y',
					'before'			=> '<li class="date">',
					'after'				=> '</li>',
				) );
			?>

			<?php
				$Item->categories( array(
					'before'          	=> '<li class="category">'.T_('Posted in').' ',
					'after'           	=> '</li>',
					'include_main'    	=> true,
					'include_other'   	=> true,
					'include_external'	=> true,
					'link_categories' 	=> true,
				) );
			?>

			<?php
				/*
				$Item->permanent_link( array(
					'before'     		=> '<li>',
					'after'       		=> '</li>',
					'text'        		=> T_( 'Permalink' ),	// possible special values: '#', '#icon#', '#text#', '#title#'
					'title'       		=> '#',
					'class'       		=> '',
				//	'format'      		=> 'htmlbody',
				) );
				*/
			?>

			<?php
				/* Old style item */
				// Output number of views
				echo ( '<li class="views">' );
				$Item->views();
				echo ( '</li>' );
			?>

			<?php
				// Link to comments, trackbacks, etc.:
				$Item->feedback_link( array(
					'type' 				=> 'feedbacks',
					'link_before' 		=> '<li class="feedback">',
					'link_after' 		=> '</li>',
					'link_text_zero' 	=> '#',
					'link_text_one' 	=> '#',
					'link_text_more' 	=> '#',
					'link_title' 		=> '#',
					'use_popup' 		=> false,
				) );
			?>

		</ul>
		</div>

		<div class="metadata">
		
			<div class="floatright">

	          	<?php 
	          		$Item->locale_flag( array(
							'before'    => ' &nbsp; ',
							'after'     => ' &nbsp; ',
	 						'class'		=> '',         		
						) );
				?>
	
				<?php
					$Item->edit_link( array( // Link to backoffice for editing
						'before'       		=> ' ',
						'after'        		=> ' ',
						'text'         		=> '#',
						'title'        		=> '#',
						'class'        		=> '',
						'save_context' 		=> true,
					) );
				?>
				
			</div>
			
			&nbsp;

			<?php
				// List all tags attached to this post:
				$Item->tags( array(
					'before' 			=> T_('Tags').': ',
					'after' 			=> ' ',
					'separator' 		=> ', ',
				) );
			?>

		</div>
	</div>

	<?php
		locale_restore_previous();	// Restore previous locale (Blog locale)
}
	?>

<?php
	// -------------------- PREV/NEXT PAGE LINKS (POST LIST MODE) --------------------
	mainlist_page_links( array(
			'block_start' 		=> '<div class="navigation">',
			'block_end' 		=> '</div>',
   			'prev_text' 		=> '&lt;&lt;',
   			'next_text' 		=> '&gt;&gt;',
		) );
	// ------------------------- END OF PREV/NEXT PAGE LINKS -------------------------
?>


</div>


<?php
// ------------------------- SIDEBAR INCLUDED HERE --------------------------
skin_include( '_sidebar.inc.php' );
// Note: You can customize the default BODY footer by copying the
// _body_footer.inc.php file into the current skin folder.
// ----------------------------- END OF SIDEBAR -----------------------------
?>

<?php
// ------------------------- SIDEBAR INCLUDED HERE --------------------------
skin_include( '_sidebar_2.inc.php' );
// Note: You can customize the default BODY footer by copying the
// _body_footer.inc.php file into the current skin folder.
// ----------------------------- END OF SIDEBAR -----------------------------
?>

<?php
// ------------------------- BODY FOOTER INCLUDED HERE --------------------------
skin_include( '_body_footer.inc.php' );
// Note: You can customize the default BODY footer by copying the
// _body_footer.inc.php file into the current skin folder.
// ------------------------------- END OF FOOTER --------------------------------
?>


<?php
// ------------------------- HTML FOOTER INCLUDED HERE --------------------------
skin_include( '_html_footer.inc.php' );
// Note: You can customize the default HTML footer by copying the
// _html_footer.inc.php file into the current skin folder.
// ------------------------------- END OF FOOTER --------------------------------
?>
