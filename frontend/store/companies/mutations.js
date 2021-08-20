import mutation from "./mutation-types";
export default {
  [mutation.SET_COMPANIES](state, companies) {
    state.companies = companies;
  },
  [mutation.SET_FILTERS](state, filters) {
    state.filters = filters;
  },
  [mutation.SET_FACULTIES](state, faculties) {
    state.faculties = faculties;
  },
  [mutation.SET_DOCUMENTS](state, documents) {
    state.documents = documents;
  },
  [mutation.SET_TAGS](state, tags) {
    state.tags = tags;
  },
  [mutation.MANAGE_ACTIVE_TAGS](state, tag) {
    state.activeTags.includes(tag)
      ? state.activeTags.splice(state.activeTags.indexOf(tag), 1)
      : state.activeTags.push(tag);
  },
  [mutation.RESET_ACTIVE_TAGS](state) {
    state.activeTags = [];
  },
  [mutation.SET_COMPANIES_MERGED](state, companiesMerged) {
    state.companiesMerged = companiesMerged;
  },
};
