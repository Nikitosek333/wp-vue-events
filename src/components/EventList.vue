<template>
  <div>
    <h1>События из WordPress</h1>
    <ul v-if="events.length">
      <li v-for="event in events" :key="event.id">
        <h2>{{ event.title }}</h2>
        <div v-html="event.content"></div>
      </li>
    </ul>
    <p v-else>Загрузка событий...</p>
  </div>
</template>

<script>
export default {
  data() {
    return {
      events: []
    };
  },
  mounted() {
    fetch('http://memosprite.local/wp-json/custom/v1/events')
      .then(res => res.json())
      .then(data => {
        this.events = data;
      })
      .catch(err => console.error('Ошибка загрузки событий:', err));
  }
};
</script>