<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header(); ?>
<div class="page">
  <section class="section bg-light-aqua">
    <div class="content">
      <div class="row">
        <div class="col-sm-12">
          <h1>The page you are looking for has not been found</h1>
          <br>
          <h2>Please try the following:</h2>

          <ul>
            <li>Check your spelling</li>
            <li>Return to the <a href="/">home page</a></li>
            <li>Click the <a href="javascript:history.back()">Back</a> button</li>
          </ul>
        </div>
      </div>
  </section>
</div>
<?php get_footer();
