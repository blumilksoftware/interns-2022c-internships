<template>
  <div class="fieldContainer">
    <div class="companyIcon">
      <img
        class="imgIcon"
        src="../assets/blumilklogo.png"
        alt="Company Logo Icon"
      />
    </div>
    <div class="companyText">
      <span>Nazwa Bardzo Duzej Firmy, w sumie to nawet jeszcze większej</span>
    </div>
    <div class="course noselect">
      <span class="noselect">Informatyka</span>
    </div>
    <div class="tagsList textContainer noselect">
      <span class="tags">.Net,C#,Azure,JS, tag1, tag2, tag3</span>
    </div>
    <div class="city"><span>Legnica</span></div>
    <div class="payInfo">
      <img src="../assets/paidicon.svg" alt="paidicon" />
    </div>
  </div>
</template>

<style lang="scss" scoped>
.fieldContainer {
  display: grid;
  grid-template-columns: 1.5fr 4.5fr 3fr 4fr 2.6fr 1.4fr;
  grid-template-rows: 1fr;
  gap: 0px 0px;
  grid-template-areas: "companyLogo companyName course tags city payInfo";
  align-items: center;
  justify-items: center;
  font-size: 14px;
  height: 50px;

  .companyIcon {
    grid-area: companyLogo;
    border-radius: 50%;
    border: 2px solid grey;
    height: 25px;
    width: 25px;

    .imgIcon {
      padding: 1px;
      border-radius: 50%;
    }
  }

  .companyText {
    overflow: hidden;
    width: 160px;
    margin-left: 0em;
    grid-area: companyName;
    position: relative;
    justify-self: start;

    &:hover {
      span {
        transform: translateX(calc(160px - 100%));
      }
    }

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
    background: #4e9dd7;
    grid-area: course;
    display: flex;
    height: 100%;
    padding: 0 10px;
    justify-items: center;
    align-items: center;
  }
  .tagsList {
    grid-area: tags;
    font-size: 12px;

    .tags {
      text-align: center;
      display: inline-block;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
      -webkit-transition: 1.5s;
      -moz-transition: 1.5s;
      transition: 1.5s;
      transform: translateX(0);
      -webkit-transition-timing-function: linear;
      -moz-transition-timing-function: linear;
      transition-timing-function: linear;
    }
  }
  .textContainer {
    overflow: hidden;
    width: 100px;
    margin-left: 0em;
    &:hover {
      .tags {
        transform: translateX(calc(100px - 100%));
      }
    }
  }
  .city {
    grid-area: city;
    font-size: 12px;
  }
  .payInfo {
    grid-area: payInfo;
  }
}
</style>
