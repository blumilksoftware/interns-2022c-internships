import types from "./mutation-types";

export const fetchData = async (url) => {
  const response = await fetch(url);
  return response.json();
};

export default {
  async fetchCompanies({ commit }) {
    await fetchData("/api/faculties/wydzial-techniczny/companies.json").then(
      (data) => {
        commit(types.SET_COMPANIES, data);
      }
    );
  },
  async fetchFilters({ commit }) {
    await fetchData("/api/faculties/wydzial-techniczny/filters.json").then(
      (data) => {
        commit(types.SET_FILTERS, data);
      }
    );
  },
  async fetchFaculties({ commit }) {
    await fetchData("/api/faculties/faculties.json").then((data) => {
      commit(types.SET_FACULTIES, data);
    });
  },
  async fetchDocuments({ commit }) {
    await fetchData(
      "/api/faculties/wydzial-techniczny/documents/documents.json"
    ).then((data) => {
      commit(types.SET_DOCUMENTS, data);
    });
  },
  async fetchTags({ commit }) {
    await fetchData("/api/faculties/wydzial-techniczny/filters.json").then(
      (data) => {
        commit(types.SET_TAGS, data.tags);
      }
    );
  },
  async fetchCompaniesMerged({ getters, dispatch, commit }) {
    await dispatch("fetchCompanies");
    await dispatch("fetchFilters");
    let companies = getters.getCompanies;
    let filters = getters.getFilters;

    const lookups = Object.fromEntries(
      Object.entries(filters).map(([key, data]) => [
        key,
        data.reduce(
          (filtersData, currentFilterData) => ({
            ...filtersData,
            [currentFilterData.id]: currentFilterData.name,
          }),
          {}
        ),
      ])
    );
    const result = companies.map((company) => ({
      ...company,
      address: {
        ...company.address,
        cityName: lookups.city[company.address.cityId],
        countryName: lookups.country[company.address.countryId],
      },
      filterData: {
        ...company.filterData,
        specializationName:
          lookups.specialization[company.filterData.specialization],
        tags: company.filterData.tags.map((tag) => lookups.tags[tag]),
      },
    }));
    commit(types.SET_COMPANIES_MERGED, result);
  },
};
