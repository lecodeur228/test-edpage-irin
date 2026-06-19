import type { NewsCategoryModel, NewsTagModel } from '@creopse/utils'

export interface CatalogState {
  categories: NewsCategoryModel[]
  tags: NewsTagModel[]
}

export const useNewsStore = defineStore('news', {
  state: (): CatalogState => ({
    categories: [],
    tags: [],
  }),
  getters: {
    mainCategories: (state) => {
      return state.categories.filter((category) => {
        return category.parentId === null
      })
    },
    subCategories: (state) => (id: number) => {
      return state.categories.filter((category) => {
        return category.parentId === id
      })
    },
    orderedCategories: (state) => {
      const orderedCategories: NewsCategoryModel[] = []
      const categories = state.categories.sort((a, b) => {
        if (a.name < b.name) return -1
        if (a.name > b.name) return 1
        return 0
      })

      for (const category of categories) {
        if (!category.parentId) {
          orderedCategories.push(category)
          const childrenCategories = categories
            .filter((c) => c.parentId === category.id)
            .sort((a, b) => {
              if (a.name < b.name) return -1
              if (a.name > b.name) return 1
              return 0
            })
          orderedCategories.push(...childrenCategories)
        }
      }

      return orderedCategories
    },
    tagsByArticlesCount: (state) => {
      return state.tags.sort((a, b) => {
        if (a.articlesCount == null || b.articlesCount == null) return 0
        if (a.articlesCount < b.articlesCount) return 1
        if (a.articlesCount > b.articlesCount) return -1
        return 0
      })
    },
  },
  actions: {},
})
