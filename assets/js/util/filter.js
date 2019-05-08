export function getByKeyword(list, keyword) {
    const search = keyword.trim().toLowerCase()
    if (!search.length) return list
    return list.filter(item => item.name.toLowerCase().indexOf(search) > -1)
}