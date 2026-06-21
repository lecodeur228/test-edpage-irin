<script lang="ts" setup>
  import type { SectionProps } from '@creopse/utils'

  const props = defineProps<SectionProps>()

  const { getSectionRootData, getSectionData } = useContent()
  const { tr, rHtml } = useHelper()

  const root = getSectionRootData(props.sectionKey)
  const sectionData = getSectionData(props.sectionKey)
  const posts = computed(() => sectionData?.posts ?? [])
</script>

<template>
  <div class="vl-blog-1-area sp2">
    <div class="container">
      <div class="row">
        <div class="col-xl-6 m-auto">
          <div class="heading1 text-center space-margin60">
            <h5 class="vl-section-subtitle" data-aos="zoom-in-up" data-aos-duration="900">
              <img src="/assets/img/elements/elements5.png" alt="">
              <span>{{ tr(root?.subtitle) || 'BLOG & News' }}</span>
              <img src="/assets/img/elements/elements6.png" alt="">
            </h5>
            <div class="space16"></div>
            <h2 class="vl-section-title" data-aos="zoom-in-up" data-aos-duration="1000">
              {{ tr(root?.title) || 'Smarter Power Brighter Future!' }}
            </h2>
          </div>
        </div>
      </div>
      <div class="row">
        <div v-for="(post, index) in posts" :key="index" class="col-xl-4 col-md-6" data-aos="fade-left" :data-aos-duration="900 + index * 100">
          <div class="vl-blog-1-item">
            <div class="vl-blog-1-thumb image-anime">
              <img :src="post.image || '/assets/img/all-images/blog/blog-img1.png'" :alt="tr(post.title)">
            </div>
            <div class="vl-blog-1-content">
              <div class="vl-blog-meta">
                <ul>
                  <li><a href="#"><i class="fa-solid fa-calendar-days"></i> {{ post.date || 'Jan 24, 2025' }}</a></li>
                  <li><a href="#"><i class="fa-solid fa-user"></i> {{ tr(post.author) || 'Joshua Jones' }}</a></li>
                </ul>
              </div>
              <div class="space18"></div>
              <h4 class="vl-blog-1-title"><a :href="post.link || '/blog'">{{ tr(post.title) }}</a></h4>
              <div class="space12"></div>
              <p v-html="rHtml(post.excerpt)"></p>
              <div class="space24"></div>
              <div class="vl-blog-1-icon">
                <a :href="post.link || '/blog'" class="readmore">Read More <i class="fa-solid fa-arrow-right"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
