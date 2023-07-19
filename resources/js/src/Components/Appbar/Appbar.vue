<template>
  <v-app-bar elevation="2">
    <v-badge dot color="success">
      <v-icon>mdi-home-outline</v-icon>
    </v-badge>

    <v-spacer></v-spacer>

    <slot></slot>
  </v-app-bar>
</template>

<script>
export default {
  name: "Appbar",

  data() {
    return {};
  },
};
</script>
