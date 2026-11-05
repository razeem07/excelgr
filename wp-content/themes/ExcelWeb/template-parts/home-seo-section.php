<?php
// Homepage text section driven by one field group on the home page — e.g.
// 'led_types' or 'monsoon'. Top row: badge + H2 on the left, short intro on the
// right. Below, full width: the content, which may use the seo-* blocks styled
// here (price cards, fact cards, note + CTA footer row, price table).
$eg_seo_section = get_field( $args['field'] );
if ( empty( $eg_seo_section['title'] ) && empty( $eg_seo_section['content'] ) ) {
	return;
}
?>
<section class="eg-seo-section">
  <div class="eg-seo-top">
    <div class="eg-seo-head">
      <?php if ( ! empty( $eg_seo_section['badge'] ) ) : ?>
        <div class="eg-seo-badge">
          <span class="eg-seo-diamond">◆</span>
          <span class="eg-seo-badge-text fade-left"><?php echo esc_html( $eg_seo_section['badge'] ); ?></span>
        </div>
      <?php endif; ?>
      <h2 class="eg-seo-title fade-right"><?php echo esc_html( $eg_seo_section['title'] ); ?></h2>
    </div>
    <?php if ( ! empty( $eg_seo_section['intro'] ) ) : ?>
      <div class="eg-seo-intro">
        <?php echo wp_kses_post( $eg_seo_section['intro'] ); ?>
      </div>
    <?php endif; ?>
  </div>
  <?php if ( ! empty( $eg_seo_section['content'] ) ) : ?>
    <div class="eg-seo-body">
      <?php echo wp_kses_post( $eg_seo_section['content'] ); ?>
    </div>
  <?php endif; ?>
</section>

<?php if ( ! did_action( 'mytheme_home_seo_section_styles' ) ) : do_action( 'mytheme_home_seo_section_styles' ); ?>
<style>
.eg-seo-section {
  width: calc(100% - 40px);
  max-width: 100%;
  margin: 60px auto 90px;
  padding: 20px 80px;
  box-sizing: border-box;
  color: #111111;
}

/* Top row: heading left, intro right (same rhythm as "Our Highlights") */
.eg-seo-top {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  gap: 48px;
  margin-bottom: 48px;
}

.eg-seo-head {
  flex: 1.1;
  max-width: 600px;
}

.eg-seo-intro {
  flex: 1.2;
  padding-top: 20px;
  font-size: 1.15rem;
  line-height: 1.65;
  color: #333333;
}

.eg-seo-intro p {
  margin: 0 0 16px 0;
}

.eg-seo-intro p:last-child {
  margin-bottom: 0;
}

.eg-seo-badge {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 24px;
}

.eg-seo-diamond {
  color: #1ba3b0;
  font-size: 1.2rem;
  line-height: 1;
}

.eg-seo-badge-text {
  font-size: 1.2rem;
  font-weight: 700;
  color: #111111;
}

.eg-seo-title {
  font-size: 3rem;
  font-weight: 800;
  line-height: 1.12;
  letter-spacing: -1.2px;
  color: #0d0d0d;
  margin: 0;
}

/* Full-width body */
.eg-seo-body {
  font-size: 1.1rem;
  line-height: 1.65;
  color: #333333;
}

.eg-seo-body p {
  margin: 0 0 16px 0;
}

.eg-seo-intro a,
.eg-seo-body a {
  color: #158590;
  font-weight: 700;
  text-underline-offset: 3px;
}

/* Price cards: one card per board type, across the full width */
.eg-seo-body .seo-price-cards {
  display: grid;
  grid-template-columns: repeat(5, 1fr);
  gap: 20px;
  margin: 0 0 28px 0;
}

.eg-seo-body .seo-price-card {
  position: relative;
  display: flex;
  flex-direction: column;
  background-color: #ffffff;
  border: 1px solid #e9ecef;
  border-radius: 20px;
  padding: 28px 24px 26px;
  transition: border-color 0.3s ease, box-shadow 0.3s ease, transform 0.3s ease;
}

.eg-seo-body .seo-price-card:hover {
  border-color: #1ba3b0;
  box-shadow: 0 14px 30px rgba(0, 0, 0, 0.06);
  transform: translateY(-3px);
}

.eg-seo-body .seo-price-card.is-featured {
  background: linear-gradient(160deg, #1ba3b0 0%, #0d7a85 100%);
  border-color: transparent;
  color: #ffffff;
}

.eg-seo-body .seo-price-tag {
  position: absolute;
  top: -12px;
  left: 24px;
  background-color: #0d0d0d;
  color: #ffffff;
  font-size: 0.72rem;
  font-weight: 700;
  letter-spacing: 0.4px;
  text-transform: uppercase;
  padding: 4px 12px;
  border-radius: 50px;
}

.eg-seo-body .seo-price-from {
  font-size: 0.85rem;
  font-weight: 600;
  color: #6c757d;
}

.eg-seo-body .seo-price-amount {
  font-size: 2.1rem;
  font-weight: 800;
  line-height: 1.1;
  letter-spacing: -0.8px;
  color: #0d7a85;
}

.eg-seo-body .seo-price-unit {
  font-size: 0.9rem;
  font-weight: 600;
  color: #6c757d;
  margin-bottom: 18px;
}

.eg-seo-body .seo-price-card h3 {
  font-size: 1.1rem;
  font-weight: 800;
  line-height: 1.3;
  color: #0d0d0d;
  margin: auto 0 6px 0;
  padding-top: 18px;
  border-top: 1px solid #e9ecef;
}

.eg-seo-body .seo-price-card p {
  font-size: 0.95rem;
  line-height: 1.5;
  color: #555555;
  margin: 0;
}

.eg-seo-body .seo-price-card.is-featured .seo-price-from,
.eg-seo-body .seo-price-card.is-featured .seo-price-unit,
.eg-seo-body .seo-price-card.is-featured p {
  color: rgba(255, 255, 255, 0.85);
}

.eg-seo-body .seo-price-card.is-featured .seo-price-amount,
.eg-seo-body .seo-price-card.is-featured h3 {
  color: #ffffff;
}

.eg-seo-body .seo-price-card.is-featured h3 {
  border-top-color: rgba(255, 255, 255, 0.3);
}

/* Fact cards (e.g. IP65 / warranty / electricity) */
.eg-seo-body .seo-facts {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 20px;
  list-style: none;
  margin: 0;
  padding: 0;
}

.eg-seo-body .seo-facts li {
  background-color: #f8f9fa;
  border-radius: 20px;
  padding: 30px 28px;
  font-size: 1rem;
  line-height: 1.6;
  color: #444444;
}

.eg-seo-body .seo-facts .seo-fact-value {
  display: block;
  font-size: 2rem;
  font-weight: 800;
  line-height: 1.1;
  letter-spacing: -0.8px;
  color: #0d7a85;
  margin-bottom: 6px;
}

.eg-seo-body .seo-facts strong {
  display: block;
  font-size: 1.1rem;
  color: #0d0d0d;
  margin-bottom: 8px;
}

/* Footer row: note on the left, links + CTA on the right */
.eg-seo-body .seo-foot {
  display: flex;
  align-items: center;
  gap: 32px;
}

.eg-seo-body .seo-foot > * {
  flex: 1;
}

.eg-seo-body .seo-foot-action p {
  margin: 0 0 16px 0;
}

.eg-seo-body .seo-note {
  background-color: #f8f9fa;
  border-left: 4px solid #1ba3b0;
  border-radius: 0 16px 16px 0;
  padding: 18px 22px;
  font-size: 1rem;
  line-height: 1.65;
}

.eg-seo-body .seo-note p {
  margin: 0;
}

.eg-seo-body .seo-btn {
  display: inline-flex;
  align-items: center;
  background: linear-gradient(135deg, #1ba3b0 0%, #0d7a85 100%);
  color: #ffffff;
  font-size: 1.02rem;
  font-weight: 700;
  line-height: 1.3;
  padding: 15px 30px;
  border-radius: 50px;
  text-decoration: none;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.eg-seo-body .seo-btn:hover {
  color: #ffffff;
  transform: translateY(-2px);
  box-shadow: 0 10px 24px rgba(13, 122, 133, 0.25);
}

/* Price table (still supported for content that uses one) */
.eg-seo-body .seo-table-wrap {
  width: 100%;
  overflow-x: auto;
  margin: 0 0 24px 0;
  border: 1px solid #e9ecef;
  border-radius: 20px;
}

.eg-seo-body .seo-table {
  width: 100%;
  border-collapse: collapse;
  font-size: 1rem;
  line-height: 1.5;
}

.eg-seo-body .seo-table th,
.eg-seo-body .seo-table td {
  padding: 15px 18px;
  text-align: left;
  vertical-align: top;
  border-bottom: 1px solid #e9ecef;
}

.eg-seo-body .seo-table thead th {
  background-color: #0d7a85;
  color: #ffffff;
  font-size: 0.9rem;
  text-transform: uppercase;
  border-bottom: none;
}

.eg-seo-body .seo-table tbody tr:last-child th,
.eg-seo-body .seo-table tbody tr:last-child td {
  border-bottom: none;
}

@media (max-width: 1300px) {
  .eg-seo-section {
    padding: 20px 40px;
  }
  .eg-seo-body .seo-price-cards {
    grid-template-columns: repeat(3, 1fr);
  }
}

@media (max-width: 992px) {
  .eg-seo-top {
    flex-direction: column;
    gap: 20px;
    margin-bottom: 32px;
  }
  .eg-seo-head {
    max-width: 100%;
  }
  .eg-seo-intro {
    padding-top: 0;
  }
  .eg-seo-body .seo-facts {
    grid-template-columns: 1fr;
  }
  .eg-seo-body .seo-foot {
    flex-direction: column;
    align-items: stretch;
    gap: 20px;
  }
}

@media (max-width: 640px) {
  .eg-seo-section {
    padding: 20px 20px;
  }
  .eg-seo-title {
    font-size: 2.05rem;
  }
  .eg-seo-intro,
  .eg-seo-body {
    font-size: 1.05rem;
  }
  /* Two compact cards per row on phones; an odd last card spans the row */
  .eg-seo-body .seo-price-cards {
    grid-template-columns: repeat(2, 1fr);
    gap: 14px;
  }
  .eg-seo-body .seo-price-card {
    padding: 22px 16px 18px;
  }
  .eg-seo-body .seo-price-card:last-child:nth-child(odd) {
    grid-column: 1 / -1;
  }
  .eg-seo-body .seo-price-amount {
    font-size: 1.65rem;
  }
  .eg-seo-body .seo-price-unit {
    margin-bottom: 12px;
  }
  .eg-seo-body .seo-price-card h3 {
    font-size: 1rem;
    padding-top: 12px;
  }
  .eg-seo-body .seo-price-card p {
    font-size: 0.88rem;
  }
  .eg-seo-body .seo-price-tag {
    left: 16px;
    font-size: 0.66rem;
  }
  .eg-seo-body .seo-btn {
    width: 100%;
    justify-content: center;
    text-align: center;
  }
}
</style>
<?php endif; ?>
