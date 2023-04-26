export function mountQueryString(filter: Filter): string {
  return `?${createUrlSearchParams(filter)}${mountArrayQueryString(filter.regions)}`
}

function createUrlSearchParams(state: Filter) {
  const copy = { ...state }
  delete copy.regions

  const searchParams = new URLSearchParams()

  Object.keys(copy).forEach((key: any) => {
    const data = state[key as keyof Filter] as string
    if (data == null) {
      return
    }
    searchParams.append(key, data)
  })

  const test = searchParams.toString()
  return test
}

function mountArrayQueryString(regions?: string[]): string {
  if (!regions) {
    return '&'
  }

  return regions.reduce((result, region) => (result += `regions[]=${region}&`), '&')
}
