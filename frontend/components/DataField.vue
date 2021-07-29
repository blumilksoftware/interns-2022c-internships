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
        <span>Nazwa Bardzo Duzej Firmy, w sumie to nawet jeszcze większej</span>
      </div>
      <div class="course noselect">
        <span>Informatyka</span>
      </div>
      <div class="companyInfo noselect">
        <div class="city">
          <img src="../assets/icons/locationIcon.svg" alt="locationicon" /><span
            >Legnica</span
          >
        </div>
        <div class="payInfo">
          <img src="../assets/icons/dollarIcon.svg" alt="paidicon" />
          <span>Płatne</span>
        </div>
      </div>
    </div>
    <div v-if="!isMobile()" class="tagsContainer">
      <span class="tag">.Net</span>
      <span class="tag">C#</span>
      <span class="tag">Azure</span>
      <span class="tag">JavaScript</span>
      <span class="tag">PHP</span>
      <span class="tag">Java</span>
    </div>
  </div>
</template>
<script>
export default {
  methods: {
    isMobile() {
      if (window.innerHeight > window.innerWidth) {
        return true;
      } else {
        return false;
      }
    },
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
    border: 2px solid grey;
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
    display: flex;

    span {
      text-align: center;
      display: inline-block;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
      -webkit-transition: 2.5s;
      -moz-transition: 2.5s;
      transition: 2.5s;
      transform: translateX(0);
      -webkit-transition-timing-function: linear;
      -moz-transition-timing-function: linear;
      transition-timing-function: linear;
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
  .textContainer {
    overflow: hidden;
    width: 220px;
    margin-left: 0em;
    text-overflow: ellipsis;
    &:hover {
      .tags {
        transform: translateX(calc(100px - 100%));
      }
    }
  }
  .companyInfo {
    grid-area: companyInfo;
    justify-self: start;
    display: flex;

    div {
      display: flex;
      align-items: center;
      font-size: 12px;
      color: #6a6a6a;
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
  margin: 5px 10px 10px 15px;
  padding-bottom: 5px;
  display: flex;
  flex-wrap: wrap;
  .tag {
    border: 1px solid #6a6a6a;
    border-radius: 30px;
    padding: 0px 8px;
    margin: 5px 3px;
    text-align: center;
    font-size: 12px;
  }
}
</style>
