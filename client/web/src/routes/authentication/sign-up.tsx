import { createFileRoute } from '@tanstack/react-router'

export const Route = createFileRoute('/authentication/sign-up')({
  component: SignUp,
})

export default function SignUp() {
  return (
    <div className='w-full h-full bg-black text-white'>sign-up</div>
  )
}

