import { createFileRoute } from '@tanstack/react-router'

export const Route = createFileRoute('/account/update-password')({
  component: () => <div>Hello /account/update-password!</div>,
})
