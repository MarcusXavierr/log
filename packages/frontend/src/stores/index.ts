import { createStore } from 'vuex'
import { mountQueryString } from '../services/mountQueryString'

export const store = createStore<State>({
  state() {
    return {
      filter: {},
      isOnDetailPage: false
    }
  },
  mutations: {
    clearStoreFilter(state) {
      state.filter = {}
    },
    setStoreFilter(state, filter: Filter) {
      state.filter = filter
    },
    goToDetailPage(state) {
      state.isOnDetailPage = true
    },

    goToDashboard(state) {
      state.isOnDetailPage = false
    }
  },
  actions: {
    async getDashboardData({ state }) {
      const response = await fetch(
        `${import.meta.env.VITE_BACKEND_URL}/api/dashboard${mountQueryString(state.filter)}`
      )
      if (!response.ok) {
        throw new Error('could not get items')
      }

      return await response.json()
    },

    async getProductsDetails({ state }) {
      const response = await fetch(
        `${import.meta.env.VITE_BACKEND_URL}/api/detail-products${mountQueryString(state.filter)}`
      )
      if (!response.ok) {
        throw new Error('could not get items')
      }

      return await response.json()
    }
  }
})
