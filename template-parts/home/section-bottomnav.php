<?php

$is_en = str_contains($_SERVER['REQUEST_URI'], '/en/');
$blog_id = $is_en ? 742 : get_option('page_for_posts');

?>

<!-- Bottom navigation / Dolna nawigacja -->
<section id="<?php esc_html_e( 'kontakt-lub-blog', 'wg-blank' ); ?>" class="bottom-nav-home">
    <div class="container container--mid container--xxl-keep-mid">

        <nav>
            <ul>
                <li>
                    <a href="mailto:&#105;&#110;&#102;&#111;&#64;&#119;&#51;&#119;&#103;&#46;&#99;&#111;&#109;" class="bottom-nav__redirect" title="<?php esc_html_e( 'Kontakt ze mną', 'wg-blank' ); ?>"><?php esc_html_e( 'Skontaktuj się', 'wg-blank' ); ?></a>
                </li>
                <li>
                    <a href="<?php echo esc_url(get_permalink($blog_id)); ?>" class="bottom-nav__redirect" title="<?php esc_html_e( 'Przekierowanie do podstrony bloga', 'wg-blank' ); ?>" rel="next"><?php esc_html_e( 'Przejdź do bloga', 'wg-blank' ); ?></a>
                </li>
            </ul>
        </nav>

    </div>
</section>