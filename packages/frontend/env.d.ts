/// <reference types="vite/client" />
interface State {
  filter: Filter
  isOnDetailPage: boolean
}

interface Filter {
  minPrice?: number
  maxPrice?: number
  startDate?: string
  endDate?: string
  productName?: string
  regions?: string[]
}
