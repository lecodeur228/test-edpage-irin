export const useDataloader = () => {
  const { loadTags, loadCategories } = useNews()
  const { tags, categories } = storeToRefs(useNewsStore())

  const initializeData = async () => {
    tags.value = await loadTags()
    categories.value = await loadCategories()
  }

  return {
    initializeData,
  }
}
