import { createFileRoute } from '@tanstack/react-router'

export const Route = createFileRoute('/account/update-email')({
  component: () => <div>Hello /account/update-email!</div>,
})
