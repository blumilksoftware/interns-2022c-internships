<template>
  <div>
    <div class="fieldContainer">
      <div class="companyIcon noselect">
        <img
          class="imgIcon"
          src="../assets/images/blumilklogo.png"
          alt="Company Logo Icon"
        />
      </div>
      <div class="companyName noselect">
        <span>{{ companyName }}</span>
      </div>
      <div class="course noselect">
        <span>{{ course }}</span>
      </div>
      <div class="companyInfo noselect">
        <div class="city">
          <img src="../assets/icons/locationIcon.svg" alt="locationicon" /><span
            >{{ location }}</span
          >
        </div>
        <div class="payInfo">
          <img src="../assets/icons/dollarIcon.svg" alt="paidicon" />
          <span>Płatne</span>
        </div>
      </div>
    </div>
    <div v-if="!isMobile()" class="tagsContainer">
      <span class="tag" v-for="tag in companyTags" :key="tag">{{ tag }}</span>
    </div>
  </div>
</template>
<script>
import { isMobile } from "../functions/functions.js";

export default {
  props: {
    companyName: {
      type: String,
      required: true,
    },
    course: {
      type: String,
      required: true,
    },
    location: {
      type: String,
      required: true,
    },
    companyTags: {
      type: Array,
    },
  },
  methods: {
    isMobile,
  },
};
</script>

<style lang="scss" scoped>
.fieldContainer {
  display: grid;
  grid-template-columns: 0.9fr 2fr 1.1fr 1.9fr;
  grid-template-rows: 1fr 1fr;
  gap: 0px 0px;
  grid-template-areas:
    "companyIcon companyName companyName course"
    "companyIcon companyInfo companyInfo course";
  align-items: center;
  justify-items: center;
  font-size: 14px;
  padding: 10px 10px 10px 4px;

  .companyIcon {
    grid-area: companyIcon;
    border-radius: 50%;
    border: 2px solid var(--darkGreyColor);
    height: 45px;
    width: 45px;

    .imgIcon {
      padding: 1px;
      border-radius: 50%;
    }
  }

  .companyName {
    width: 160px;
    margin-left: 0em;
    grid-area: companyName;
    position: relative;
    justify-self: start;
    align-self: end;
    font-size: 16px;
    display: inline-block;
    overflow: hidden;

    span {
      min-width: 100%;
      display: inline-block;
      white-space: nowrap;
      text-overflow: ellipsis;
      transform: translateX(0);
      transition: 3s;
      &:hover {
        transform: translateX(calc(160px - 100%));
      }
    }
  }
  .course {
    grid-area: course;
    display: flex;
    height: 100%;
    padding: 0 10px;
    justify-self: end;
    align-items: center;
    font-size: 16px;
  }
  .companyInfo {
    grid-area: companyInfo;
    justify-self: start;
    display: flex;

    div {
      display: flex;
      align-items: center;
      font-size: 12px;
      color: var(--darkGreyColor);
    }

    div img {
      display: inline-block;
      margin-right: 4px;
    }
    .city {
      margin-right: 5px;
    }
  }
}
.tagsContainer {
  width: 100%;
  margin: 5px 10px 10px 20px;
  padding-bottom: 5px;
  display: flex;
  flex-wrap: wrap;
  .tag {
    border: 1px solid var(--darkGreyColor);
    border-radius: 30px;
    padding: 0px 8px;
    margin: 5px 3px;
    text-align: center;
    font-size: 12px;
  }
}
</style>
