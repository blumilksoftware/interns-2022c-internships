import types from "./mutation-types";
export default {
  [types.SET_COMPANIES](state, companies) {
    state.companies = companies;
  },
  [types.SET_FILTERS](state, filters) {
    state.filters = filters;
  },
  [types.SET_FACULTIES](state, faculties) {
    state.faculties = faculties;
  },
  [types.SET_DOCUMENTS](state, documents) {
    state.documents = documents;
  },
  [types.SET_TAGS](state, tags) {
    state.tags = tags;
  },
  [types.MANAGE_ACTIVE_TAGS](state, tag) {
    state.activeTags.includes(tag)
      ? state.activeTags.splice(state.activeTags.indexOf(tag), 1)
      : state.activeTags.push(tag);
  },
  [types.RESET_ACTIVE_TAGS](state) {
    state.activeTags = [];
  },
};
