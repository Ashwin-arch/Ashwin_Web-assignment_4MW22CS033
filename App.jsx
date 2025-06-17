import { Box, Heading, Text, Button } from "@chakra-ui/react";
import SpaceScene from "./components/SpaceScene";

export default function App() {
  return (
    <Box bg="gray.900" color="white" minH="100vh" p={8}>
      <Heading mb={4}>🚀 SkyAI</Heading>
      <Text mb={4}>Explore planets, stars, and galaxies with AI</Text>
      <Button colorScheme="teal" mb={8}>Start Exploring</Button>
      <SpaceScene />
    </Box>
  );
}
