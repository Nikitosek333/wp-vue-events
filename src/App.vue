<template>
  <div id="app">
    <EventList />
  </div>
</template>

<script>
import EventList from './components/EventList.vue'

export default {
  name: 'App',
  components: {
    EventList
  }
}
</script>