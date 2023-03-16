<header class="nh pt-20">
  <?php cf_get_template('breadcrumbs.php', CF_TEMPLATES_DIR) ?>
  <div class="container pt-u-sm-20 pb-d-sm-20">
    <div class="row-u-md jc-u-lg-sb">
      <div class="col-u-lg-7 col-o-md ta-o-xs-c pr-u-lg-60">
        <h1 class="mb-15">
          <?php the_title(); ?>
          <?php if ( $news['subtitle'] ) : ?>
          <span class="d-b tc-n fs-u-sm-24 fs-o-xs-20 fw-m mt-10"><?php echo $news['subtitle']; ?></span>
          <?php endif; ?>
        </h1>

        <p class="d-f ai-c jc-o-xs-c mb-20 fs-12">
          <svg class="mr-5" width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M1.48309 1.48309C2.41715 0.549037 3.67915 0.0168446 5 0C6.32085 0.0168446 7.58285 0.549037 8.51691 1.48309C9.45096 2.41715 9.98316 3.67915 10 5C9.99383 5.76946 9.81014 6.52711 9.46324 7.21396C9.11635 7.90081 8.6156 8.49833 8 8.96V9H7.95C7.10341 9.64874 6.06658 10.0003 5 10.0003C3.93342 10.0003 2.89659 9.64874 2.05 9H2V8.96C1.3844 8.49833 0.883651 7.90081 0.536756 7.21396C0.18986 6.52711 0.00617444 5.76946 0 5C0.0168446 3.67915 0.549037 2.41715 1.48309 1.48309ZM3.55954 7.61681C3.29308 7.83144 3.10799 8.13072 3.035 8.465C3.63057 8.8154 4.309 9.00018 5 9.00018C5.691 9.00018 6.36943 8.8154 6.965 8.465C6.89201 8.13072 6.70692 7.83144 6.44046 7.61681C6.17399 7.40219 5.84215 7.28511 5.5 7.285H4.5C4.15785 7.28511 3.82601 7.40219 3.55954 7.61681ZM6.88446 6.70418C7.29456 6.97728 7.61481 7.36547 7.805 7.82C8.17967 7.45149 8.47805 7.01277 8.68309 6.5289C8.88814 6.04503 8.99582 5.5255 9 5C8.98703 3.94316 8.56144 2.93327 7.81409 2.18591C7.06673 1.43856 6.05684 1.01297 5 1C3.94316 1.01297 2.93327 1.43856 2.18591 2.18591C1.43856 2.93327 1.01297 3.94316 1 5C1.00418 5.5255 1.11186 6.04503 1.31691 6.5289C1.52195 7.01277 1.82033 7.45149 2.195 7.82C2.38519 7.36547 2.70544 6.97728 3.11554 6.70418C3.52564 6.43108 4.00729 6.28525 4.5 6.285H5.5C5.99271 6.28525 6.47436 6.43108 6.88446 6.70418ZM4.22741 2.13971C4.47284 2.04138 4.73567 1.99385 5 2.00001C5.26433 1.99385 5.52716 2.04138 5.77259 2.13971C6.01803 2.23804 6.24097 2.38513 6.42792 2.57209C6.61488 2.75905 6.76198 2.98198 6.8603 3.22742C6.95863 3.47285 7.00616 3.73568 7 4.00001C7.00616 4.26434 6.95863 4.52717 6.8603 4.7726C6.76198 5.01804 6.61488 5.24098 6.42792 5.42794C6.24097 5.61489 6.01803 5.76199 5.77259 5.86032C5.52716 5.95865 5.26433 6.00617 5 6.00001C4.73567 6.00617 4.47284 5.95865 4.22741 5.86032C3.98197 5.76199 3.75903 5.61489 3.57208 5.42794C3.38512 5.24098 3.23802 5.01804 3.1397 4.7726C3.04137 4.52717 2.99384 4.26434 3 4.00001C2.99384 3.73568 3.04137 3.47285 3.1397 3.22742C3.23802 2.98198 3.38512 2.75905 3.57208 2.57209C3.75903 2.38513 3.98197 2.23804 4.22741 2.13971ZM4.60984 4.937C4.73408 4.98498 4.86697 5.00644 5 5.00001C5.13303 5.00644 5.26592 4.98498 5.39016 4.937C5.5144 4.88902 5.62723 4.81559 5.7214 4.72141C5.81557 4.62724 5.88901 4.51441 5.93699 4.39017C5.98497 4.26594 6.00643 4.13304 6 4.00001C6.00643 3.86699 5.98497 3.73409 5.93699 3.60985C5.88901 3.48561 5.81557 3.37278 5.7214 3.27861C5.62723 3.18444 5.5144 3.111 5.39016 3.06302C5.26592 3.01504 5.13303 2.99358 5 3.00001C4.86697 2.99358 4.73408 3.01504 4.60984 3.06302C4.4856 3.111 4.37277 3.18444 4.2786 3.27861C4.18443 3.37278 4.11099 3.48561 4.06301 3.60985C4.01503 3.73409 3.99357 3.86699 4 4.00001C3.99357 4.13304 4.01503 4.26594 4.06301 4.39017C4.11099 4.51441 4.18443 4.62724 4.2786 4.72141C4.37277 4.81559 4.4856 4.88902 4.60984 4.937Z" fill="#545454"/></svg>
          <?php the_author(); ?> /
          <svg class="mx-5" width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M3.6 0.799988C3.70609 0.799988 3.80783 0.842131 3.88284 0.917145C3.95786 0.99216 4 1.0939 4 1.19999V1.59999H8V1.19999C8 1.0939 8.04214 0.99216 8.11716 0.917145C8.19217 0.842131 8.29391 0.799988 8.4 0.799988C8.50609 0.799988 8.60783 0.842131 8.68284 0.917145C8.75786 0.99216 8.8 1.0939 8.8 1.19999V1.59999H10C10.3183 1.59999 10.6235 1.72642 10.8485 1.95146C11.0736 2.1765 11.2 2.48173 11.2 2.79999V9.99999C11.2 10.3182 11.0736 10.6235 10.8485 10.8485C10.6235 11.0736 10.3183 11.2 10 11.2H2C1.68174 11.2 1.37652 11.0736 1.15147 10.8485C0.926428 10.6235 0.8 10.3182 0.8 9.99999V2.79999C0.8 2.48173 0.926428 2.1765 1.15147 1.95146C1.37652 1.72642 1.68174 1.59999 2 1.59999H3.2V1.19999C3.2 1.0939 3.24214 0.99216 3.31716 0.917145C3.39217 0.842131 3.49391 0.799988 3.6 0.799988ZM8 2.39999V2.79999C8 2.90607 8.04214 3.00782 8.11716 3.08283C8.19217 3.15784 8.29391 3.19999 8.4 3.19999C8.50609 3.19999 8.60783 3.15784 8.68284 3.08283C8.75786 3.00782 8.8 2.90607 8.8 2.79999V2.39999H10C10.1061 2.39999 10.2078 2.44213 10.2828 2.51715C10.3579 2.59216 10.4 2.6939 10.4 2.79999V3.99999H1.6V2.79999C1.6 2.6939 1.64214 2.59216 1.71716 2.51715C1.79217 2.44213 1.89391 2.39999 2 2.39999H3.2V2.79999C3.2 2.90607 3.24214 3.00782 3.31716 3.08283C3.39217 3.15784 3.49391 3.19999 3.6 3.19999C3.70609 3.19999 3.80783 3.15784 3.88284 3.08283C3.95786 3.00782 4 2.90607 4 2.79999V2.39999H8ZM1.6 4.79999V9.99999C1.6 10.1061 1.64214 10.2078 1.71716 10.2828C1.79217 10.3578 1.89391 10.4 2 10.4H10C10.1061 10.4 10.2078 10.3578 10.2828 10.2828C10.3579 10.2078 10.4 10.1061 10.4 9.99999V4.79999H1.6ZM5.6 5.99999C5.6 5.8939 5.64214 5.79216 5.71716 5.71714C5.79217 5.64213 5.89391 5.59999 6 5.59999C6.10609 5.59999 6.20783 5.64213 6.28284 5.71714C6.35786 5.79216 6.4 5.8939 6.4 5.99999C6.4 6.10607 6.35786 6.20782 6.28284 6.28283C6.20783 6.35784 6.10609 6.39999 6 6.39999C5.89391 6.39999 5.79217 6.35784 5.71716 6.28283C5.64214 6.20782 5.6 6.10607 5.6 5.99999ZM7.6 5.59999C7.49391 5.59999 7.39217 5.64213 7.31716 5.71714C7.24214 5.79216 7.2 5.8939 7.2 5.99999C7.2 6.10607 7.24214 6.20782 7.31716 6.28283C7.39217 6.35784 7.49391 6.39999 7.6 6.39999C7.70609 6.39999 7.80783 6.35784 7.88284 6.28283C7.95786 6.20782 8 6.10607 8 5.99999C8 5.8939 7.95786 5.79216 7.88284 5.71714C7.80783 5.64213 7.70609 5.59999 7.6 5.59999ZM8.8 5.99999C8.8 5.8939 8.84214 5.79216 8.91716 5.71714C8.99217 5.64213 9.09391 5.59999 9.2 5.59999C9.30609 5.59999 9.40783 5.64213 9.48284 5.71714C9.55786 5.79216 9.6 5.8939 9.6 5.99999C9.6 6.10607 9.55786 6.20782 9.48284 6.28283C9.40783 6.35784 9.30609 6.39999 9.2 6.39999C9.09391 6.39999 8.99217 6.35784 8.91716 6.28283C8.84214 6.20782 8.8 6.10607 8.8 5.99999ZM9.2 7.19999C9.09391 7.19999 8.99217 7.24213 8.91716 7.31714C8.84214 7.39216 8.8 7.4939 8.8 7.59999C8.8 7.70607 8.84214 7.80782 8.91716 7.88283C8.99217 7.95784 9.09391 7.99999 9.2 7.99999C9.30609 7.99999 9.40783 7.95784 9.48284 7.88283C9.55786 7.80782 9.6 7.70607 9.6 7.59999C9.6 7.4939 9.55786 7.39216 9.48284 7.31714C9.40783 7.24213 9.30609 7.19999 9.2 7.19999ZM7.2 7.59999C7.2 7.4939 7.24214 7.39216 7.31716 7.31714C7.39217 7.24213 7.49391 7.19999 7.6 7.19999C7.70609 7.19999 7.80783 7.24213 7.88284 7.31714C7.95786 7.39216 8 7.4939 8 7.59999C8 7.70607 7.95786 7.80782 7.88284 7.88283C7.80783 7.95784 7.70609 7.99999 7.6 7.99999C7.49391 7.99999 7.39217 7.95784 7.31716 7.88283C7.24214 7.80782 7.2 7.70607 7.2 7.59999ZM6 7.19999C5.89391 7.19999 5.79217 7.24213 5.71716 7.31714C5.64214 7.39216 5.6 7.4939 5.6 7.59999C5.6 7.70607 5.64214 7.80782 5.71716 7.88283C5.79217 7.95784 5.89391 7.99999 6 7.99999C6.10609 7.99999 6.20783 7.95784 6.28284 7.88283C6.35786 7.80782 6.4 7.70607 6.4 7.59999C6.4 7.4939 6.35786 7.39216 6.28284 7.31714C6.20783 7.24213 6.10609 7.19999 6 7.19999ZM4 7.59999C4 7.4939 4.04214 7.39216 4.11716 7.31714C4.19217 7.24213 4.29391 7.19999 4.4 7.19999C4.50609 7.19999 4.60783 7.24213 4.68284 7.31714C4.75786 7.39216 4.8 7.4939 4.8 7.59999C4.8 7.70607 4.75786 7.80782 4.68284 7.88283C4.60783 7.95784 4.50609 7.99999 4.4 7.99999C4.29391 7.99999 4.19217 7.95784 4.11716 7.88283C4.04214 7.80782 4 7.70607 4 7.59999ZM2.8 7.19999C2.69391 7.19999 2.59217 7.24213 2.51716 7.31714C2.44214 7.39216 2.4 7.4939 2.4 7.59999C2.4 7.70607 2.44214 7.80782 2.51716 7.88283C2.59217 7.95784 2.69391 7.99999 2.8 7.99999C2.90609 7.99999 3.00783 7.95784 3.08284 7.88283C3.15786 7.80782 3.2 7.70607 3.2 7.59999C3.2 7.4939 3.15786 7.39216 3.08284 7.31714C3.00783 7.24213 2.90609 7.19999 2.8 7.19999ZM2.4 9.19999C2.4 9.0939 2.44214 8.99216 2.51716 8.91714C2.59217 8.84213 2.69391 8.79999 2.8 8.79999C2.90609 8.79999 3.00783 8.84213 3.08284 8.91714C3.15786 8.99216 3.2 9.0939 3.2 9.19999C3.2 9.30607 3.15786 9.40782 3.08284 9.48283C3.00783 9.55785 2.90609 9.59999 2.8 9.59999C2.69391 9.59999 2.59217 9.55785 2.51716 9.48283C2.44214 9.40782 2.4 9.30607 2.4 9.19999ZM4.4 8.79999C4.29391 8.79999 4.19217 8.84213 4.11716 8.91714C4.04214 8.99216 4 9.0939 4 9.19999C4 9.30607 4.04214 9.40782 4.11716 9.48283C4.19217 9.55785 4.29391 9.59999 4.4 9.59999C4.50609 9.59999 4.60783 9.55785 4.68284 9.48283C4.75786 9.40782 4.8 9.30607 4.8 9.19999C4.8 9.0939 4.75786 8.99216 4.68284 8.91714C4.60783 8.84213 4.50609 8.79999 4.4 8.79999ZM5.6 9.19999C5.6 9.0939 5.64214 8.99216 5.71716 8.91714C5.79217 8.84213 5.89391 8.79999 6 8.79999C6.10609 8.79999 6.20783 8.84213 6.28284 8.91714C6.35786 8.99216 6.4 9.0939 6.4 9.19999C6.4 9.30607 6.35786 9.40782 6.28284 9.48283C6.20783 9.55785 6.10609 9.59999 6 9.59999C5.89391 9.59999 5.79217 9.55785 5.71716 9.48283C5.64214 9.40782 5.6 9.30607 5.6 9.19999ZM7.6 8.79999C7.49391 8.79999 7.39217 8.84213 7.31716 8.91714C7.24214 8.99216 7.2 9.0939 7.2 9.19999C7.2 9.30607 7.24214 9.40782 7.31716 9.48283C7.39217 9.55785 7.49391 9.59999 7.6 9.59999C7.70609 9.59999 7.80783 9.55785 7.88284 9.48283C7.95786 9.40782 8 9.30607 8 9.19999C8 9.0939 7.95786 8.99216 7.88284 8.91714C7.80783 8.84213 7.70609 8.79999 7.6 8.79999Z" fill="#545454"/></svg>
          <?php echo get_the_date('M d, Y'); ?>
        </p>

        <?php if (has_post_thumbnail()) : ?>
          <figure class="d-u-md-n mb-d-sm-20">
            <?php the_post_thumbnail('news', ['class' => 'br-12']); ?>
          </figure>
        <?php endif; ?>

        <?php if ( $news['quick_info'] ) : ?>
          <div class="wp-editor"><?php echo $news['quick_info']; ?></div>
        <?php endif; ?>
      </div>

      <?php if (has_post_thumbnail()) : ?>
        <div class="col-u-md-5 d-d-sm-n mt-u-md-10 ta-c">
          <figure class="h-u-md-100p d-u-md-f ai-u-md-c jc-u-md-c br-u-md-12 of-u-md-h ps-u-md-r">
            <?php the_post_thumbnail('news', ['class' => 'nh__img ps-u-md-a']); ?>
          </figure>
        </div>
      <?php endif; ?>
    </div>
  </div>
</header>