import os
import sys
import subprocess

def run_command(command):
    try:
        print(f"Running: {command}")
        result = subprocess.run(command, check=True, text=True, shell=True, capture_output=True)
        print(result.stdout)
        return True
    except subprocess.CalledProcessError as e:
        print(f"Error executing '{command}': {e}")
        print(e.stderr)
        return False

def main():
    commit_message = "Updates to events page"
    if len(sys.argv) > 1:
        commit_message = " ".join(sys.argv[3:])

    print("Status:")
    run_command("git status")

    print("\nAdding files...")
    if not run_command("git add ."):
        return

    print(f"\nCommitting with message: '{commit_message}'...")
    if not run_command(f'git commit -m "{commit_message}"'):
        print("Nothing to commit or commit failed. Attempting to push anyway...")

    print("\nPushing to remote...")
    if not run_command("git push"):
        return
        
    print("\nSuccessfully pushed to GitHub!")

if __name__ == "__main__":
    main()
