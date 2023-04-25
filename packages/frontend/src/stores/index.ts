import { createStore } from 'vuex'
import { mountQueryString } from '../services/mountQueryString'

export const store = createStore<State>({
  state() {
    return {
    }
  },
  mutations: {
    clearStoreFilter(state) {
      Object.assign(state, {})
    },
    setStoreFilter(state, filter: State) {
      Object.assign(state, filter)
    }
  },
  actions: {
    async getDashboardData({ state }) {
      const response = await fetch(`${import.meta.env.VITE_BACKEND_URL}/api/dashboard${mountQueryString(state)}`)
      if (! response.ok) {
        throw new Error('could not get items')
      }

      return await response.json()
    }
  }
})


